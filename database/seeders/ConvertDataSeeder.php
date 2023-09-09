<?php

namespace Database\Seeders;

use App\Repositories\Eloquent\DataRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConvertDataSeeder extends Seeder
{
    protected $dataRepository;
    public function __construct(DataRepository $dataRepository)
    {
        $this->dataRepository=$dataRepository;

    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = public_path('data/data.csv');
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $dataConverted = [];
        while ($row = fgetcsv($file)) {
            $dataConverted[] = array_combine($header, $row);

        }
       foreach ($dataConverted as $newData){

       $dataLower  = array_change_key_case($newData, CASE_LOWER);
       $this->dataRepository->updateOrCreate(['name'=>$dataLower],$dataLower);

       }
        fclose($file);
    }


}
