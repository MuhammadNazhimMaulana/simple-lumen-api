<?php

class CategoryTest extends TestCase
{
    /**
     * /category [GET]
     */
    public function testShouldReturnAllCategories(){

        $this->get("api/category", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            [
                'name',
                'slug',
                'created_at',
                'updated_at'
            ]
        ]);
        
    }

    /**
     * /category/id [GET]
     */
    public function testShouldReturnCategory(){
        $this->get("api/category/1", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'name',
            'slug',
            'created_at',
            'updated_at'
        ]);
        
    }

    /**
     * /category [POST]
     */
    public function testShouldCreateCategory(){

        $parameters = [
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
        ];

        $this->post("api/category", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'name',
            'slug',
            'created_at',
            'updated_at'
        ]);
        
    }
    
    /**
     * /category/id [PUT]
     */
    public function testShouldUpdateCategory(){

        $parameters = [
            'name' => 'Kesehatan Update',
            'slug' => 'kesehatah-update',
        ];

        $this->put("api/category/1", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /category/id [DELETE]
     */
    public function testShouldDeleteCategory(){
        
        $this->delete("api/category/1", [], []);
        $this->seeStatusCode(200);
    }

}