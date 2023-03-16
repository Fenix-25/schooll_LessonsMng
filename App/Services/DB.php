<?php

namespace App\Services;

use PDO;

class DB
{
	public mixed $query;
	public mixed $where = null;
	public mixed $order = null;

	public function insert($table, array $data): void
	{
		$query = "insert into " . $table . self::prepareValue($data)['key'] . " values" . self::prepareValue($data)['value'];
		$this->query = DB::connect()->prepare($query);
		foreach ($data as $key => $value) {
			$this->query->bindValue(":" . $key, $value);
		}
		$this->query->execute();
	}

	public static function prepareValue(array $data): array
	{
		$res['key'] = "(" . htmlspecialchars(implode(', ', array_keys(($data)))) . ")";
		$res['value'] = "( :" . htmlspecialchars(implode(', :', array_keys(($data)))) . ")";
		return $res;
	}

	public function connect(): PDO
	{
		$pdo = new PDO(DSN, USER, PASSWORD, OPTIONS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}

	public function update($table, array $data, $where): void
	{
		$set = '';
		foreach ($data as $key => $value) {
			$set .= "{$key}=:{$key},";
		}
		$set = rtrim($set, ',');
		$query = "UPDATE $table SET $set WHERE $where";
		$this->query = DB::connect()->prepare($query);

		foreach ($data as $key => $value) {
			$this->query->bindValue(":" . $key, $value);
		}

		$this->query->execute();
	}

	public function select($table, $row = "*"): static
	{
		//select * from users where id=1
		$query = "select {$row} from {$table}";
		$this->where && $query .= " where {$this->where} ";
		$this->order && $query .= " order by {$this->order}";
		$this->query = DB::connect()->prepare($query);
		$this->query->execute();
		return $this;
	}

	public function where($where):static
	{
		$this->where = $where;
		return $this;
	}

	public function order($orderBy): static
	{
		$this->order = $orderBy;
		return $this;
	}

	public function raw($query): static
	{
		$this->query = DB::connect()->prepare($query);
		$this->query->execute();
		return $this;
	}

	public function get()
	{
		return $this->query->fetch(PDO::FETCH_ASSOC);
	}

	public function all()
	{
		return $this->query->fetchAll(PDO::FETCH_ASSOC);
	}

}