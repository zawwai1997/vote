<?php

class Vote
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function hasVotingClosed()
    {
        $query = "SELECT status_name FROM status WHERE id= :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':id' => 1));

        if($stmt->rowCount() > 0)
        {
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data->status_name == 1 ? TRUE : FALSE;
        }
    }

    public function allCount($table,$attr){
        $query = "SELECT sum($attr) FROM `$table` ";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function hasVotedKQ($table = 'person', $column, $user)
    {
        $query = "SELECT $column FROM $table WHERE `generate_code` = :user";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $data= $stmt->fetch(PDO::FETCH_OBJ);
            return $data->$column == 1 ? TRUE : FALSE;
        }
    }

    public function updateVoteCount($table, $vote_person)
    {
        $existing_vote_count = $this->getVoteCount($table, $vote_person)['vote_count'];
        $query = "UPDATE $table SET `vote_count` = {$existing_vote_count} + 1 WHERE `id` = {$vote_person}";
        $stmt = $this->pdo->prepare($query);
        $boolean =  $stmt->execute();
        return $boolean;
    }
    
    public function userVote($table, $status, $user_id){
        $query = "UPDATE {$table} SET {$status} = 1 WHERE `generate_code` = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $boolean = $stmt->execute();
        return $boolean;
    }

    public function getVotes() {
        $king_votes = $this->getVote('kings');
        $queen_votes = $this->getVote('queens');

        $k_arr = [];
        $q_arr = [];
        
        foreach($king_votes as $key => $vote) {
            array_push($k_arr, $vote['vote_count']);
        }

        foreach($queen_votes as $key => $vote) {
            array_push($q_arr, $vote['vote_count']);
        }

        $all_votes = array(
            'king_votes' => $k_arr,
            'queen_votes' => $q_arr
        );

        return $all_votes;
    }

    public function getContent($table = 'content') {
        $query = "SELECT * FROM " . $table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getDataFrom($table) {
        $query = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDataFromMaximun($table,$attr,$count) {
        //$query = "SELECT * FROM $table";
        $query = "SELECT * FROM $table order by $attr desc limit $count";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWinner($table) {
        $query = "SELECT mytable.id, mytable.name, mytable.vote_count
                    FROM {$table} mytable
                    WHERE vote_count = 
                    (SELECT MAX(vote_count) FROM {$table})";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * private functions
     */
    
    private function getVoteCount($table, $id) {
        $query = "SELECT `vote_count` FROM {$table} WHERE `id` = {$id}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getVote($table) {
        $query = "SELECT `vote_count` FROM `$table`";
        $stmt  = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}