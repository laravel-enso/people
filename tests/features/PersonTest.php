<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Forms\TestTraits\CreateForm;
use LaravelEnso\Forms\TestTraits\DestroyForm;
use LaravelEnso\Forms\TestTraits\EditForm;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Tables\Traits\Tests\Datatable;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use Datatable;
    use DestroyForm;
    use CreateForm;
    use EditForm;
    use RefreshDatabase;

    private $permissionGroup = 'administration.people';
    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = Person::factory()->test()->make();
    }

    #[Test]
    public function can_view_create_form()
    {
        $this->get(route($this->permissionGroup.'.create', false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    #[Test]
    public function can_store_person()
    {
        $response = $this->post(
            route('administration.people.store', [], false),
            $this->testModel->toArray() +
                ['companies' => []]
        );

        $person = Person::whereEmail($this->testModel->email)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message'])
            ->assertJsonFragment([
                'redirect' => 'administration.people.edit',
                'param'    => ['person' => $person->id],
            ]);
    }

    #[Test]
    public function can_update_person()
    {
        $this->testModel->save();

        $this->testModel->name = 'updated';

        $this->patch(
            route('administration.people.update', $this->testModel->id, false),
            $this->testModel->toArray() +
                ['companies' => []]
        )->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->name);
    }

    #[Test]
    public function get_option_list()
    {
        $this->testModel->save();

        $this->get(route('administration.people.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->testModel->name]);
    }

    #[Test]
    public function validates_that_main_company_belongs_to_selected_companies()
    {
        $company = Company::factory()->test()->create();
        $otherCompany = Company::factory()->test()->create();

        $this->post(route('administration.people.store', [], false), [
            ...$this->testModel->toArray(),
            'companies' => [$company->id],
            'company'   => $otherCompany->id,
        ])->assertStatus(302)
            ->assertSessionHasErrors(['company']);
    }

    #[Test]
    public function syncs_companies_and_marks_main_company_on_store()
    {
        $firstCompany = Company::factory()->test()->create();
        $secondCompany = Company::factory()->test()->create();

        $this->post(route('administration.people.store', [], false), [
            ...$this->testModel->toArray(),
            'companies' => [$firstCompany->id, $secondCompany->id],
            'company'   => $secondCompany->id,
        ])->assertStatus(200);

        $person = Person::whereEmail($this->testModel->email)->firstOrFail();

        $this->assertCount(2, $person->companies);
        $this->assertSame($secondCompany->id, $person->company()->id);
        $this->assertTrue((bool) $person->companies->firstWhere('id', $secondCompany->id)->pivot->is_main);
        $this->assertFalse((bool) $person->companies->firstWhere('id', $firstCompany->id)->pivot->is_main);
    }

    #[Test]
    public function forbids_changing_email_for_person_that_has_a_user()
    {
        $person = Person::factory()->test()->create();

        User::factory()->create([
            'person_id' => $person->id,
            'email'     => $person->email,
        ]);

        $this->patch(route('administration.people.update', $person->id, false), [
            ...$person->toArray(),
            'email'     => 'changed@example.com',
            'companies' => [],
        ])->assertStatus(403);
    }
}
