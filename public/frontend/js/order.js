
// Counter to keep track of the number of orders
let orderCount = 1;

// Function to add a new order table
function addOrder() {
    const ordersContainer = document.getElementById('orders-container');

    // Create a new table element
    const orderTable = document.createElement('table');
    orderTable.innerHTML = `
        <caption>Order ${orderCount}</caption>
        <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Item"></td>
          <td><input type="number" placeholder="Price"></td>
          <td><input type="number" placeholder="Quantity"></td>
        </tr>
      `;

    // Increment the order count
    orderCount++;

    // Append the new table to the container
    ordersContainer.appendChild(orderTable);
}

// Add event listener to the button
document.getElementById('add-order-btn').addEventListener('click', addOrder);
