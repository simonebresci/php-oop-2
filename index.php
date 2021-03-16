<!-- Creare uno shop online.
strutturare le classi gestendo l'ereditarietà dove necessario.
provare a far interagire tra di loro gli oggetti (l'utente dello shop per esempio inserisce una carta di credito)
$c = new CreditCard(..);
$user->insertCreditCard($c);
BONUS: gestire le eccezioni. (es: carta di credito scaduta). -->

<?php
// USER & SONS =================================================================
class User{
  private $id;
  protected $name;
  protected $surname;


  // __construct
  public function __construct(string $id,string $name,string $surname) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;

  }

  //GETTER
  public function getId(){
    return $this->id;
  }

  public function getname(){
    return $this->name;
  }

  public function getSurname(){
    return $this->surname;
  }


}

class UserSigned extends User {
  protected $email;
  private   $password;
  protected $cart;
  protected $houseAddress;
  protected $billingAddress;
  protected $shoppedItems = [];

  // GETTER
  public function getEmail(){
    return $this->email;
  }

  public function getCart(){
    return $this->cart;
  }

  public function getHouseAddress(){
    return $this->houseAddress;
  }

  public function getBillingAddress(){
    return $this->billingAddress;
  }

  public function getShoppedItems(){
    return $this->shoppedItems;
  }

  // SETTER
  public function setEmail($email){
    $this->email = $email;
  }
  public function setCart($cart){
    $this->cart = $cart;
  }

  public function setHouseAddress($houseAddress){
    $this->houseAddress = $houseAddress;
  }

  public function setBillingAddress($billingAddress){
    $this->billingAddress = $billingAddress;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function addShoppedItems($shoppedItems){
    $this->shoppedItems[] = $shoppedItems;
  }

  public function displayCartPin(){
    echo "Il pin attuale della sua carta è: " . $this->cart->getPin();
  }

  public function resetCartPin(){
    $this->cart->setPin("0000");
  }

  public function buyArticle($article){
    // Permetti acquisto se carta valida
    // if($this->$cart->checkValidCart()){
      $this->addShoppedItems($article);
    // }
  }

}

class Visitor extends User{

}
// USER & SONS =================================================================
// CART & SONS =================================================================
class Cart{
  private $id;
  private $pin;
  private $brand;
  protected $expiration;

  // __construct
  public function __construct(string $id,string $pin,string $brand,string $expiration) {
        $this->id = $id;
        $this->pin = $pin;
        $this->brand = $brand;
        $this->expiration = $expiration;

  }

  public function getId(){
    return $this->id;
  }

  public function getPin(){
    return $this->pin;
  }

  public function getBrand(){
    return $this->brand;
  }

  public function getExpiration(){
    return $this->expiration;
  }

  public function setPin($pin){
    $this->pin = $pin;
  }

  public function checkValidCart(){
    return ($this->expiration > 2021); //Upgrade with dynamic data!
  }
}
// /CART & SONS =================================================================
class Address{
  private $city;
  private $street;
  private $houseNumber;
  private $postalCode;

  public function __construct(string $city,string $street,string $houseNumber,string $postalCode) {
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->postalCode = $postalCode;
  }
  public function getCity(){
    return $this->city;
  }

  public function getStreet(){
    return $this->street;
  }

  public function getHouseNumber(){
    return $this->houseNumber;
  }

  public function getpostalCode(){
    return $this->postalCode;
  }
}

// ARTICLE & SONS ==============================================================
class article{
  private $id;
  protected $name;
  protected $pathImage;
  protected $size;
  protected $prize;

  public function __construct(string $id,string $name,string $pathImage,string $size, string $prize) {
        $this->id = $id;
        $this->name = $name;
        $this->pathImage = $pathImage;
        $this->size = $size;
        $this->prize = $prize;
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getPathImage(){
    return $this->pathImage;
  }
  public function getsize(){
    return $this->size;
  }

  public function getPrize(){
    return $this->prize;
  }

  public function setName($name){
    $this->password = $name;
  }

  public function setPathImage($pathImage){
    $this->password = $pathImage;
  }

  public function setSize($size){
    $this->password = $size;
  }

  public function setPrize($prize){
    $this->password = $prize;
  }

}

//==============================================================================



// }

// USER
$pippo = new User("00000001", "Pippo","Baudo");
$pippoSigned = new UserSigned("00000001", "Pippo","Baudo");
$pippoSigned->setEmail("pippobaudo@gmail.com");
$pippoSigned->setPassword("pipponazionale");

$pippoSigned->setHouseAddress(new Address("Milano","via Monte Napoleone", "45","200019"));
$pippoSigned->setBillingAddress(new Address("Ostia","via del canbianco", "22","771056"));

$cartPippo = new Cart("cart_001","14785","VISA",2025);
$pippoSigned->setCart($cartPippo);


$article1 = new Article("art_001","Sedia","img/art_001","33x33x33cm","9,99€");
$article2 = new Article("art_002","Tavolo","img/art_002","33x33x33cm","9,99€");
$article3 = new Article("art_003","Televisore","img/art_003","33x33x33cm","9,99€");

$pippoSigned->buyArticle($article1);
$pippoSigned->buyArticle($article3);
$pippoSigned->buyArticle($article3);
$pippoSigned->buyArticle($article2);
$pippoSigned->buyArticle($article1);
$pippoSigned->buyArticle($article2);

$pippoSigned->displayCartPin();
echo "<br>";
echo "RESET PIN IN CORSO...<br>";
$pippoSigned->resetCartPin();
$pippoSigned->displayCartPin();
echo "<hr>"

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SHOP AD OGGETTI</title>
  </head>
  <body>
    <div class="user">
      <?php echo "ID: " . $pippoSigned->getID() . "<br>"?>
      <?php echo "Name: " . $pippoSigned->getName() . "<br>" ?>
      <?php echo "Surname: " . $pippoSigned->getSurname() . "<br>" ?>
      <?php echo "Cart:  " . $pippoSigned->getCart()->getId() . "<br>" ?>
      <?php echo "House Address: " . $pippoSigned->getHouseAddress()->getCity()
                . " - " . $pippoSigned->getHouseAddress()->getStreet()
                . " - " . $pippoSigned->getHouseAddress()->getHouseNumber()

      . "<br>" ?>
      <?php echo "Billing Address: " . $pippoSigned->getBillingAddress()->getCity()
                . " - " . $pippoSigned->getBillingAddress()->getStreet()
                . " - " . $pippoSigned->getBillingAddress()->getHouseNumber()

      . "<br>" ?>

       <?php foreach($pippoSigned->getShoppedItems() as $key => $art){
         echo "Shopped item " . $key . " : ". $art->getID() . "<br>";
       }
       ?>



    </div>
    <hr>
    <div class="cart">
      <?php echo "ID:" . $cartPippo->getID() . "<br>"?>
      <?php echo "Name:" . $cartPippo->getPin() . "<br>" ?>
      <?php echo "Surname:" . $cartPippo->getBrand() . "<br>" ?>
      <?php echo "Expiration:" . $cartPippo->getExpiration() . "<br>" ?>
    </div>
    <hr>
    <div class="articles">

      <h3> Articolo 1 </h3>
      <?php echo "ID:" . $article1->getId() . "<br>"?>
      <?php echo "Name:" . $article1->getName() . "<br>" ?>
      <?php echo "Surname:" . $article1->getPathImage() . "<br>" ?>
      <?php echo "Expiration:" . $article1->getSize() . "<br>" ?>
      <?php echo "Expiration:" . $article1->getPrize() . "<br>" ?>

      <h3> Articolo 2 </h3>
      <?php echo "ID:" . $article2->getId() . "<br>"?>
      <?php echo "Name:" . $article2->getName() . "<br>" ?>
      <?php echo "Surname:" . $article2->getPathImage() . "<br>" ?>
      <?php echo "Expiration:" . $article2->getSize() . "<br>" ?>
      <?php echo "Expiration:" . $article2->getPrize() . "<br>" ?>

      <h3> Articolo 3 </h3>
      <?php echo "ID:" . $article3->getId() . "<br>"?>
      <?php echo "Name:" . $article3->getName() . "<br>" ?>
      <?php echo "Surname:" . $article3->getPathImage() . "<br>" ?>
      <?php echo "Expiration:" . $article3->getSize() . "<br>" ?>
      <?php echo "Expiration:" . $article3->getPrize() . "<br>" ?>
    </div>

  </body>
</html>
