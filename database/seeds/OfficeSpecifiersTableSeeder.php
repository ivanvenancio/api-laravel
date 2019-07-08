<?php

use Illuminate\Database\Seeder;

class OfficeSpecifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100 ; $i++)
        {
            $specifier_id = rand(1,100);
            App\Model\OfficeSpecifier::create([
                'specifier_id' => $specifier_id,
                'office_id' => rand(1,100),
                'status' =>$this->singleActive($specifier_id)
            ]);
        }
        
        
    }

    /**
     * Função que garante nos dados fictícios que somente o último escritório 
     * cadastrado fique como ativo.
     */
    private function singleActive($specifier_id){
        App\Model\OfficeSpecifier::where('specifier_id',$specifier_id)
            ->update(['status' => 'no']);

        return  'yes';
    }
}
