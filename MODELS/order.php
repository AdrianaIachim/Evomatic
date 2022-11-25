<?php
class Order
{
    private $table_name;

    private $id;
    private $user; //oggetto User
    private $cost;
    private $created_at;
    private $pick_up; //oggetto PickUp
    private $break; //oggetto Break (Pause)
    private $status; //oggetto Status
    private $products = []; //oggetto Product
}
?>