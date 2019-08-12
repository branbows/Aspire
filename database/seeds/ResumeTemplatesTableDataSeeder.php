<?php

use Illuminate\Database\Seeder;

class ResumeTemplatesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'White Template', 'resume_key' => 'white_template', 
             'slug' => 'white-template-3', 'status' => '1', 'is_default'=>'0', 
             'image'=> '1_white-template.jpeg', 'created_at'=>'2019-05-30 04:58:13', 
         	 'updated_at'=>'2019-05-30 06:25:19',],


            ['id' => 2, 'title' => 'Green Resume', 'resume_key' => 'green_template', 
             'slug' => 'green-template-3', 'status' => '1', 'is_default'=>'1', 
             'image'=> '2_green-resume-1.jpeg', 'created_at'=>'2019-05-30 05:24:57', 
         	 'updated_at'=>'2019-05-30 06:25:19',],

            ['id' => 6, 'title' => 'Yellow Template', 'resume_key' => 'yellow_template', 
             'slug' => 'yellow-template-3', 'status' => '1', 'is_default'=>'0', 
             'image'=> '6-yellow-template-3.jpeg', 'created_at'=>'2019-05-30 05:24:57', 
         	 'updated_at'=>'2019-05-30 06:25:19',],

        ];

        foreach ($items as $item) {
            \App\ResumeTemplate::create($item);
        }
    }
}
