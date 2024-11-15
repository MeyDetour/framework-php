<?php

namespace Core\Repository;

use Core\Database\PDOMysql;

abstract class Repository
{
    private $pdo;

    private $bdd;
    public function __construct()
    {
        $this->pdo = PDOMysql::getPdo()['pdo'];
        $this->bdd = PDOMysql::getPdo()['bdd'];
    }

    public function findAll()
    {
        $query = $this->pdo->query('SELECT * FROM pizza');

        //Recuperer sous forme de tableau associatif
        $items = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $items;
    }

    public function findOne($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM pizza WHERE id=:id');
        $query->execute ([
            'id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function new(array $values)
    {
        try {
            switch ($this->bdd):
                case 'mysql' :
                    $columnsNames = [];
                    $columnsDatas = [];
                    foreach ($values as $name => $value) {
                        $columnsNames[] = $name;
                        $columnsDatas[] = ":$name";
                    }
                    $columnsNames = implode(',', $columnsNames);
                    $columnsDatas = implode(',', $columnsDatas);
                    //assert that this columns names are in entity


                    $query = $this->pdo->prepare("INSERT INTO pizza ($columnsNames) VALUES ($columnsDatas)");
                    $query->execute($values);
                    break;
                case 'sqlLite':


                    break;

            return null;

        } catch (\Exception $error) {
            return $error;
        }


    }

    public function delete($id)
    {
        try {
            $query = $this->pdo->prepare('DELETE FROM pizza WHERE id=:id');
            $query->execute(['id' => $id]);
            return null;
        } catch (\Exception $error) {
            return $error;
        }


    }
    //resolve target entity
    //resolvetablename
    //findall
    //Delete
    //find


}