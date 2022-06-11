function toggleFavorite(id, isfav){
    var rawBody = {
        "id": id,
    }
    console.log(isfav)
    if(isfav == 'false'){
    fetch('../actions/action_add_favorite.php', {
        method: "POST",
        headers: { "Content-type": "application/json" },
        body: JSON.stringify(rawBody),
      }).then(response => response.json()
      ).then((response) => {
        if (response.success) {
            window.location.reload()
        } else {
          throw new Error(response.message);
        }
      });
    }
    if(isfav == 'true'){
        console.log("tesafega")
        fetch('../actions/action_remove_favorite.php', {
            method: "POST",
            headers: { "Content-type": "application/json" },
            body: JSON.stringify(rawBody),
          }).then(response => response.json()
          ).then((response) => {
            if (response.success) {
              window.location.reload();
            } else {
              throw new Error(response.message);
            }
          });
        }


}