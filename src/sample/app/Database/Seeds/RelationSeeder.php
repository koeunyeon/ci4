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
        foreach (range(1,5) as $parent_idx) {
            $sampleParentFabricator = new Fabricator(SampleParentModel::class);
            $parent = $sampleParentFabricator->makeArray();
            $sampleParentModel = new SampleParentModel();
            $parent_id = $sampleParentModel->insert($parent);


            foreach (range(1,random_int(3,8)) as $parent_idx) {
                $sampleChildFabricator = new Fabricator(SampleChildModel::class);
                $child = $sampleChildFabricator->makeArray();
                $child['sample_parent_id'] = $parent_id;
                $sampleChildModel = new SampleChildModel();
                $sampleChildModel->insert($child);
            }
        }
   }
}