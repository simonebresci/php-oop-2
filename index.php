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
  protected $shoppedItems = [];

  // GETTER
  public function getEmail(){
    return $this->email;
  }

  public function getCart(){
    return $this->cart;
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

  public function setPassword($password){
    $this->password = $password;
  }

  public function setShoppedItems($shoppedItems){
    $this->shoppedItems = $shoppedItems;
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
}
// /CART & SONS =================================================================
// class article{
//   private id;
//   protected name;
//   protected pathImage;
//   protected size;
//   protected prize;
//
//   public function __construct(string $id,string $name,string $pathImage,string $size, string $prize) {
//         $this->id = $id;
//         $this->name = $name;
//         $this->pathImage = $pathImage;
//         $this->size = $size;
//         $this->prize = $prize;
//   }
// }





// }

// USER
$pippo = new User("00000001", "Pippo","Baudo");
$pippoSigned = new UserSigned("00000001", "Pippo","Baudo");
$pippoSigned->setEmail("pippobaudo@gmail.com");
$pippoSigned->setPassword("pipponazionale");

$cartPippo = new Cart("cart_001","14785","VISA","2025/07/01");
$pippoSigned->setCart($cartPippo);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SHOP AD OGGETTI</title>
  </head>
  <body>
    <div class="user">
      <?php echo "ID:" . $pippoSigned->getID() . "<br>"?>
      <?php echo "Name:" . $pippoSigned->getName() . "<br>" ?>
      <?php echo "Surname:" . $pippoSigned->getSurname() . "<br>" ?>
      <?php echo "Cart:" . $pippoSigned->getCart()->getId() . "<br>" ?>
    </div>
    <hr>
    <div class="cart">
      <?php echo "ID:" . $cartPippo->getID() . "<br>"?>
      <?php echo "Name:" . $cartPippo->getPin() . "<br>" ?>
      <?php echo "Surname:" . $cartPippo->getBrand() . "<br>" ?>
      <?php echo "Expiration:" . $cartPippo->getExpiration() . "<br>" ?>
    </div>

  </body>
</html>
