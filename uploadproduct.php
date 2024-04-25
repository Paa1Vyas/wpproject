<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <title>Image Upload Using PHP</title>
    <style>
        body {
            display: flex;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    

    <?php if (isset($_GET['error'])): ?>
        <p><?php echo $_GET['error']; ?></p>
    <?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">
            <label>NAME</label>
            <input type="text"
                    name="name"><br>

            <label>Price</label>
            <input type="text"
                    name="price" id="price" oninput="calculateWebPrice()"><br>
                
            <label>Category</label>
            <select name="category">
                <?php
                    // Include database connection file
                    include "db_conn.php";

                    // Fetch categories from database
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);

                    // Check if there are categories
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option>No categories available</option>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                ?>
            </select><br>    
            
            <label>Description</label>
            <textarea name="description"></textarea><br>

            <label>Image</label>
           <input type="file" 
                  name="my_image"><br>

           <label>Profit Percentage (%)</label>
           <input type="number" 
                  name="profit_percentage" id="profit_percentage" oninput="calculateWebPrice()"><br>

           <input type="submit" 
                  name="submit"
                  value="Upload"><br>
      </form>

      <p id="web_price"></p>

      <script>
        function calculateWebPrice() {
            var price = document.getElementById("price").value;
            var profitPercentage = document.getElementById("profit_percentage").value;
            var webPrice = parseFloat(price) + (parseFloat(price) * (parseFloat(profitPercentage) / 100));
            document.getElementById("web_price").innerHTML = "Web Price: " + webPrice.toFixed(2);
        }
      </script>
</body>
</html>
