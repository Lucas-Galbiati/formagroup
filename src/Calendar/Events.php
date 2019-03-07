<?php

namespace Calendar;

class Events {

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Recupere les evenement commencant entre deux date
     */

    public function getEventsBetween (\DateTime $start, \DateTime $end): array {
        
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }
    /**
     * Recupere les evenement commencent entre 2 dates indexe par jour
     */
    public function getEventsBetweenByDay (\DateTime $start, \DateTime $end): array{
        $events = $this->getEventsbetween($start, $end);
        $days = [];
        foreach($events as $event){
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];

            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }
    /**
     * Recupere un evenement
     */
    public function find (int $id): Event {
       require '../src/Calendar/Event.php';
       $statement = $this->pdo->query("SELECT * FROM events WhERE id = $id  LIMIT 1");
       $statement->setFetchMode(\PDO::FETCH_CLASS,Event::class);
       $result = $statement->fetch();
       if ($result === false ) {
           throw new \Exception('Aucun résultat n\'a été trouvé');
       }
       return $result;
    }

    public function create (Event $event): bool{
        $statement = $this->pdo->prepare("INSERT INTO events (name,description,start,end) VALUES ('$name', '$description', '$start', '$end')");
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
        ]);
    }

}