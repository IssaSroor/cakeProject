<?php
namespace App\Controllers;
use App\Models\Order;
use App\Models\CancelReason;

class OrdersController
{
    private $ordersModel;
    private $cancelReasonModel;

    public function __construct()
    {
        $this->ordersModel = new Order();
        $this->cancelReasonModel = new CancelReason();
    }

    // public function index() {
    //     $customers = $this->ordersModel->showRow();
    //     require 'views/admin/customers/dash-customers.php';
    // }

    public function get()
    {
        if ($orders = $this->ordersModel->showOrders()) {
            require 'views/admin/orders/dash-orders.php'; // Adjust path as needed
        } else {
            echo 'No admins found.';
        }
    }

    public function add()
    {
        require 'views/admin/admins/dash-admin-add.php'; // Adjust the path accordingly
    }

    public function orderDetails()
    {
        $orderFilter = $_GET['id'] ?? null;
        if ($orderFilter != 'all') {
            if ($orders = $this->ordersModel->showOrderItems($orderFilter)) {
                require 'views/admin/orders/dash-manage-order.php';
            }
        } else {
            header("location:/404");
        }
    }

    function orderStatus()
    {
        $order_id = $_GET['id'];
        $status = $_GET['status'];
        $orderStatus = [
            'order_status' => $status
        ];

        if ($orderStatus['order_status'] == 'cancelled') {
            $adminId = $_SESSION['admin_id'];
            $cancelReason = $_GET['cancel_reason'];
            
            if (!empty($adminId) && !empty($order_id) && !empty($cancelReason)) {
                // Load the model and call the method to insert the cancellation reason
                 $this->cancelReasonModel->addCancelReason($adminId, $order_id, $cancelReason);   
                 $this->ordersModel->updateStatus($order_id, $orderStatus);      
                header('Location: /orderDetails?id=' . $order_id);
                }
        }
        else {
            $this->ordersModel->updateStatus($order_id, $orderStatus);
            header('location:/orderDetails?id=' . $order_id);
        }
    }

    public function placeOrder() {
        // Logic to handle placing the order, e.g., inserting order details into the database
        
            // Clear session variables related to the cart
            setcookie('cart', '', time() - 3600, '/'); // Expires the cart cookie
           
    }

}

// }