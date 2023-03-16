<?php

namespace App\Controllers;

use App\Services\DB;
use App\Services\Helper;
use App\Services\Notification;
use App\Services\Redirect;

class Classes
{
	public static function index()
	{
		$classes = self::all();
		return Helper::view('pages/classes/index', ['classes' => $classes]);
	}

	public static function all()
	{
		$c = (new DB())->select('class')->all();
		usort($c, function ($a, $b) {
			$a_code = (int)explode('-', $a['code'])[0];
			$b_code = (int)explode('-', $b['code'])[0];
			return $a_code === $b_code ? strcmp($a['number'], $b['number']) : $a_code - $b_code;
		});
		return $c;
	}

	public static function edit($classId)
	{
		$newClass = self::studentsOfClass($classId['id']);
		return Helper::view('pages/classes/edit', ['students' => $newClass]);
	}

	public static function studentsOfClass($classId): array
	{
		$query = "select * from students left join sms.class_student on students.id = class_student.student_id and class_id = {$classId}";
		$getClass = (new DB())->raw($query)->all();
		$studentsOfClass = [];
		foreach ($getClass as $student) {
			if (!empty($student['class_id'])) {
				$studentsOfClass[] = $student;
			}
		}
		return $studentsOfClass;
	}

	public static function update($request)
	{
		dd($request);
	}

	public static function create()
	{
		return Helper::view('pages/classes/create');
	}

	public static function store($request)
	{
		if (Helper::emptyFieldsErrorMsg($request, ['number', 'code'])) {
			Redirect::redirect('/create-class');
		}
		$number = htmlspecialchars($request['number']);
		$code = htmlspecialchars($request['code']);
		$class = (new DB())->select('class')
			->where("number = '{$number}' and code = '{$code}'")
			->get();
		if (!empty($class)) {
			Notification::notification('This class is already exist!');
			Redirect::redirect('/classes');
		}
		//записати в бд
		$insert = [
			'number' => $number,
			'code' => $code,
		];
		(new DB())->insert('class', $insert);
		Notification::notification('Successfully saved!', 'success');
		Redirect::redirect('/classes');
	}

	public static function CounterStudentsOfClass($class)
	{
		$e = (new DB())->where("class_id = $class")->select('class_student', 'class_id')
			->all();
		if (!empty($e)) {
			return count($e);
		}
	}

	public static function getStudentWithOutClass($classId)
	{

	}
}