<?php
namespace App\Models;

use App\Models\Model;

class Cart extends Model {
    


    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProduct($productId) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :productId");
        $stmt->execute(['productId' => $productId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getCustomerInfo($customerId) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE customer_id = :customerId");
        $stmt->execute(['customerId' => $customerId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    }

    public function createOrder($customerId, $orderTotal, $cartItems, $orderTotalAfter,$couponId,$address) {
        $this->db->beginTransaction();

        if (isset($_SESSION['coupon'])) {
            $orderTotalAfter -= $_SESSION['coupon']; 
        }

        try {
            $date = date('Y-m-d H:m:s');
            // Insert order into orders table
            $stmt = $this->db->prepare("INSERT INTO orders (customer_id, order_total_amount, order_total_amount_after,coupon_id,delivery_address,created_at) VALUES (:customer_id, :total , :total_after, :couponId, :address ,:date)");
            $stmt->execute(['customer_id' => $customerId, 'total' => $orderTotal , 'total_after' => $orderTotalAfter, 'couponId' => $couponId, 'address' => $address,'date' => $date]);
            $orderId = $this->db->lastInsertId();
            $_SESSION['orderId'] = $orderId;
            // Insert order items into order_items table
            foreach ($cartItems as $item) {
                $stmt = $this->db->prepare("INSERT INTO order_products (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
                $stmt->execute([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                   
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function addOrderProduct($orderId, $productId, $quantity, $price)
{
    $sql = "INSERT INTO order_products (order_id, product_id, quantity, price) 
            VALUES ($orderId,$productId,$quantity, $price)";
    $stmt = $this->db->prepare($sql);
    // var_dump($stmt);
    // die();
    // return $stmt->execute();
}
}
