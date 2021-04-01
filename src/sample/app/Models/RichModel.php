<?php


namespace App\Models;


use CodeIgniter\Model;

class RichModel  extends Model
{
    protected $table = 'sample_rich';
    protected $allowedFields = ['name','age'];
    protected $primaryKey = "sample_rich_id";

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	
	// 유효성 검사 규칙.
    protected $validationRules = [
        'name' => 'required|min_length[4]|max_length[10]',
        'age' => 'required|is_natural|less_than[150]',
    ];

    // 유효성 검사 실패시 에러 메세지.
    protected $validationMessages = [
        'name' => [
            'required' => '이름이 필요합니다',
            'min_length' => '이름은 최소 4글자 이상입니다.',
            'max_length' => '이름은 최대 10글자 이하입니다.'
        ],
        'age' => [
            'required' => '필수값입니다',
            'is_natural' => "나이는 자연수여야 합니다.",
            'less_than' => "정말 150세 이상이신가요?"
        ]
    ];
}