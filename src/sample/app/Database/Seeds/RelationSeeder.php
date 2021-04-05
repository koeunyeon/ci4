<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use App\Models\SampleChildModel;
use App\Models\SampleParentModel;

class RelationSeeder extends Seeder
{
   public function run()
   {
        // 임의 데이터 세팅
        foreach (range(1,5) as $parent_idx) { // (1)
            $sampleParentFabricator = new Fabricator(SampleParentModel::class); // (2)
            $parent = $sampleParentFabricator->makeArray(); // (3)
            $sampleParentModel = new SampleParentModel();
            $parent_id = $sampleParentModel->insert($parent); // (4)


            foreach (range(1,random_int(3,8)) as $parent_idx) { // (5)
                $sampleChildFabricator = new Fabricator(SampleChildModel::class); // (6)
                $child = $sampleChildFabricator->makeArray();
                $child['sample_parent_id'] = $parent_id; // (7)
                $sampleChildModel = new SampleChildModel();
                $sampleChildModel->insert($child);
            }
        }
   }
}