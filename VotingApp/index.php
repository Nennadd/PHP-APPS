<?php 
date_default_timezone_set('Europe/Belgrade');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP/Vue Voting App</title>
    <link href="./src/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="container">
        <div class="quote-div">
            <h3 class="quote">Quote: <span>&quot;{{message}}&quot;</span></h3>
            <hr>
        </div>

        <div class="form-div">
            <h1>Where to go ?</h1>

            <form action="classes/Process.php" method="POST">
                <div class="countries">
                    <div class="destination">
                    <label><input v-model="choice" type="radio" name="choice" value="thailand">
                        <img src="./src/images/thailand.jpg" alt="thailand">
                        <h3 class="country">Thailand</h3></label>
                    </div>
                    <div class="destination">
                    <label><input v-model="choice" type="radio" name="choice" value="italy">
                        <img src="./src/images/italy.jpg" alt="italy">
                        <h3 class="country">Italy</h3></label>
                    </div>
                    <div class="destination">
                    <label><input v-model="choice" type="radio" name="choice" value="bali">
                        <img src="./src/images/bali.jpg" alt="bali">
                        <h3 class="country">Bali</h3></label>
                    </div>
                </div>

                <h3 class="vote_for">Vote for: <span >{{ choice }}</span></h3>
                <div class="email_input">
                    <input v-model="email" type="email" name="email" placeholder="Your Email Address" required>
                    <input @click="vote" id="btn" class="sub" type="submit" name="vote" value="Vote">
                </div>
            </form>
        </div>
    
        <div class="result-div">
            <h2>Result</h2>
            <div class="results">
                <div class="result" v-for="country in countries">
                    <div class="result_country" v-bind:style="{width: country.percent + '%'}"></div>
                    <span>{{ country.name }} {{country.percent}}%</span>
                </div>
            </div>
        </div>

    <div class="voters-div">
        <h2 class="voters">Voters</h2>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>EMAIL</td>
                    <td>CHOICE</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.id }}</td>
                    <td>{{ user.voters_email }}</td>
                    <td>{{ user.voters_choice }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>  

    <script src="./src/scripts/vue.js"></script>
    <script src="./src/scripts/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="./src/scripts/app.js"></script>
</body>
</html>