<?php
class Booking {
  // Properties
  private $number;
  private $room;
  private $state;
  private $arrivalDate;
  private $departureDate;
  private $includesBreakfast;
  private $includesParking;
  private $bringsDog;

  // Methods
  function set_number($number) {
    $this->number = (int)$number;
  }
  function get_number() {
    return $this->number;
  }

  function set_Room($room) {
    $this->room = $room;
  }
  function get_Room() {
    return $this->room;
  }

  function set_State($state) {
    $this->state = $state;
  }
  function get_State() {
    return $this->state;
  }

  function set_arrivalDate($arrivalDate) {
    $this->arrivalDate = $arrivalDate;
  }
  function get_arrivalDate() {
    return $this->arrivalDate;
  }

  function set_departureDate($departureDate) {
    $this->departureDate = $departureDate;
  }
  function get_departureDate() {
    return $this->departureDate;
  }

  function set_includesBreakfast($includesBreakfast) {
    $this->includesBreakfast = $includesBreakfast;
  }
  function get_includesBreakfast() {
    return $this->includesBreakfast;
  }

  function set_includesParking($includesParking) {
    $this->includesParking = $includesParking;
  }
  function get_includesParking() {
    return $this->includesParking;
  }

  function set_bringsDog($bringsDog) {
    $this->bringsDog = $bringsDog;
  }
  function get_bringsDog() {
    return $this->bringsDog;
  }

  function __toString()
  {
    return 
    "Buchungsnummer: " . $this->get_number() . "<br>" .
    "Zimmer Kategorie: " . $this->get_Room() . "<br>" .
    "Buchungsstatus: " . ($this->get_State()=="new" ? 'Neu' : '') . "<br>" .
    "Anreisedatum: " . $this->get_arrivalDate()->format("d.m.Y") . "<br>" .
    "Abfahrtsdatum: " . $this->get_departureDate()->format("d.m.Y") . "<br>" .
    "Frühstück inkludiert: " . ($this->get_includesBreakfast() ? 'Ja' : 'Nein') . "<br>" .
    "Parken inkludiert: " . ($this->get_includesParking() ? 'Ja' : 'Nein') . "<br>" .
    "Bringt Hund mit: " . ($this->get_bringsDog() ? 'Ja' : 'Nein') . "<br><br>";
  }

}
//Diese Klasse wird nicht mehr verwendet
//Unser erster Ansatz war die Posts in der Session zu speichern, dafür haben wir Objekte der Klasse Post erstellt. 
//Jetzt speichern wir aber die Post in einem .json File daher werden die Objekte nicht mehr benötigt.
class Post {
  // Properties
  private $title;
  private $text;
  private $picture;
  private $author;
  private $date;
  
  // Methods
  function set_title($title) {
    $this->title = $title;
  }
  function get_title() {
    return $this->title;
  }
  function set_text($text) {
    $this->text = $text;
  }
  function get_text() {
    return $this->text;
  }
  function set_picture($picture) {
    $this->picture = $picture;
  }
  function get_picture() {
    return $this->picture;
  }
  function set_author($author) {
    $this->author = $author;
  }
  function get_author() {
    return $this->author;
  }
  function set_date($date) {
    $this->date = $date;
  }
  function get_date() {
    return $this->date;
  }

  function __toString()
  {
    return 
    "Titel: " . $this->get_title() . "<br>" .
    "Text: " . $this->get_text() . "<br>" .
    "Bild: " . $this->get_picture() . "<br>" .
    "Author: " . $this->get_author() . "<br>" .
    "Datum: " . $this->get_date()->format("d.m.Y H:i") . "<br><br>";
  }

  
}