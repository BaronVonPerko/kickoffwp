<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FieldTypeTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    function can_get_list_of_types() {
		$this->get('/fieldtypes')
			->assertStatus(200)
			->assertSee('Text Area')
			->assertSee('Text Input')
			->assertSee('Color Control')
			->assertSee('Upload Control')
			->assertSee('Image Control');
    }
}
