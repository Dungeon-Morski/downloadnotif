<?php
	class DB {
		protected static $pdo;

		protected function __construct() {

		}

		private static function getConnection() {
			$dbinfo = require "dbinfo.php";
			return self::$pdo ?? new PDO("mysql:host=$dbinfo[host];dbname=$dbinfo[dbname]",$dbinfo["username"],$dbinfo["password"]);
		}

		private static function query($sql, $params = []) {
			$pdo = self::getConnection();
			if(!$params) {
				return $pdo->query($sql);
			} else {
				$stmt = $pdo->prepare($sql);
				foreach ($params as $key => $value) {
					$stmt->bindValue(":$key", $value);
				}
				$stmt->execute();
				return $stmt;
			}
		}

		public static function getFrom($table, $sql = '', $params = []) {
			$sql = "SELECT * FROM `$table`" . $sql;
			$stmt = self::query($sql, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function addDownload($name) {
			$sql = "INSERT INTO `downloads` (`name`) VALUES (:name)";
			$params = ["name" => $name];
			return self::query($sql, $params);
		}

		public static function getCountFrom($table, $sql = '', $params = []) {
			$sql = "SELECT COUNT(*) as count FROM `$table`" . $sql;
			$stmt = self::query($sql, $params);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->fetch();
			return $row['count'];
		}

		public static function getUnicsFrom($table, $column = '',$sql = '', $params = []) {
			$sql = "SELECT DISTINCT `$column` FROM `$table`" . $sql;
			$stmt = self::query($sql, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getCountByTimeFrom($table, $sql = '', $params = []) {
			$sql = "SELECT COUNT(*) as count FROM `$table`" . $sql;
			$stmt = self::query($sql, $params);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->fetch();
			return $row['count'];
		}

		public static function getCountDowloads($days) {
            $sql = '';
			if ($days != 'all') {
				$sql = " WHERE `date` BETWEEN CURRENT_TIMESTAMP - INTERVAL $days DAY AND CURRENT_TIMESTAMP ";
			}
			return DB::getCountByTimeFrom('downloads', $sql);
		}
	}
?>