<?php 
require_once 'DB.php';

class Calculate {

    private $votes;
    public $countries = [];

    public function __construct(){
        $this->votes = $this->allVotes();
        array_push($this->countries, ['name' => 'thailand', 'percent' => $this->count('thailand')]);
        array_push($this->countries, ['name' => 'italy', 'percent' => $this->count('italy')]);
        array_push($this->countries, ['name' => 'bali', 'percent' => $this->count('bali')]);
    }

    private function allVotes(){
        $instance = DB::getInstance();
        $conn = $instance->connect();

        $sql = 'SELECT id FROM voters';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $this->votes = $stmt->rowCount();
    }

    private function count($country){
        $instance = DB::getInstance();
        $conn = $instance->connect();

        $sql = 'SELECT id FROM voters WHERE voters_choice = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$country]);
        $result = $stmt->rowCount() / $this->votes * 100;
        return number_format($result, 2);
    }
}

$votess = new Calculate;
echo json_encode($votess);