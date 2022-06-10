function updateStatus(id){
    var status = document.getElementById(id).value;
    status = JSON.parse(status);
    var rawBody = {}
    if((status['status'] != 'created') && (status['status'] != 'delivered') && (status['status'] != 'ready') &&(status['status'] != 'reviewed') &&(status['status'] != 'answered')){
        return;
    }
    rawBody['status'] = status['status'];
    rawBody['id'] = status['id'];

    fetch('../actions/action_update_status.php', {
        method: "POST",
        headers: { "Content-type": "application/json" },
        body: JSON.stringify(rawBody),
      }).then(response => response.json()
      ).then((response) => {
        if (response.success) {
          window.location.href = 'http://localhost:9000/pages/owner_orders.php?res=' + status['res'];
        } else {
          throw new Error(response.message);
        }
      });
}