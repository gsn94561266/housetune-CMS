<?php
session_start();
require_once("../db-connect.php");
if (!isset($_SESSION["user"])) {
    header("location: ../background-login.php");
}
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$perPage = 5;
$page_start = ($page - 1) * $perPage;

if (isset($_GET["search"]) && $_GET["search"] !== "") {
    $search = $_GET["search"];
    $sql = "SELECT * FROM user WHERE account LIKE '%$search%' ORDER BY created_at DESC ";
    $sql1 = "SELECT * FROM user WHERE account LIKE '%$search%' ORDER BY created_at DESC LIMIT $page_start, $perPage";
} else if (isset($_GET["startdate"]) && $_GET["startdate"] !== "") {
    $date1 = $_GET["startdate"];
    if (isset($_GET["enddate"]) && $_GET["enddate"] !== "") {
        $date2 = $_GET["enddate"];
        $sql = "SELECT * FROM user WHERE created_at >= '$date1' AND created_at<= '$date2' ORDER BY created_at DESC ";
        $sql1 = "SELECT * FROM user WHERE created_at >= '$date1' AND created_at<= '$date2' ORDER BY created_at DESC LIMIT $page_start, $perPage";
    } else {
        $sql = "SELECT * FROM user WHERE created_at >= '$date1' ORDER BY created_at DESC ";
        $sql1 = "SELECT * FROM user WHERE created_at >= '$date1' ORDER BY created_at DESC LIMIT $page_start, $perPage";
    }
} else if (isset($_GET["enddate"]) && $_GET["enddate"] !== "") {
    $date2 = $_GET["enddate"];
    $sql = "SELECT * FROM user WHERE created_at<= '$date2' ORDER BY created_at DESC ";
    $sql1 = "SELECT * FROM user WHERE created_at<= '$date2' ORDER BY created_at DESC LIMIT $page_start, $perPage";
} else if (isset($_GET["address"]) && $_GET["address"] !== "") {
    $address = $_GET["address"];
    $sql = "SELECT * FROM user WHERE address LIKE '%$address%' ORDER BY created_at DESC ";
    $sql1 = "SELECT * FROM user WHERE address LIKE '%$address%' ORDER BY created_at DESC LIMIT $page_start, $perPage";
} else if (isset($_GET["status"]) && $_GET["status"] !== "") {
    $valid = $_GET["status"];
    $sql = "SELECT * FROM user WHERE valid=$valid ORDER BY created_at DESC ";
    $sql1 = "SELECT * FROM user WHERE valid=$valid ORDER BY created_at DESC LIMIT $page_start, $perPage ";
} else {
    $sql = "SELECT * FROM user";
    $sql1 = "SELECT * FROM user ORDER BY created_at DESC LIMIT $page_start, $perPage";
}

$result = $conn->query($sql);
$userCount = $result->num_rows;
$totalPage = ceil($userCount / $perPage);
$result1 = $conn->query($sql1);
$rows = $result1->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Housetune後臺管理系統理系統</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="../scss/all.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar fixed-top shadow bg-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-4">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <a class="" href="dashboard.php">
                        <img src="./images/logo.png" alt="Logo" width="150" class="d-inline-block me-5 ms-3 my-2" href="dashboard.php">
                    </a>
                </div>
                <div class="text-white text-decoration-none ms-4">歡迎使用 Housetune 後臺管理系統</div>
            </div>
            <a class="btn btn-dark text-white" href="logout.php">Log out</a>
        </div>
    </nav>
    <aside class="left-aside position-fixed border-end bg-secondary d-flex flex-column justify-content-between">
        <nav class="aside-menu">
            <div class="pt-1 pb-2 px-3">
                Hi,<?= $_SESSION["user"]["account"] ?>
            </div>
            <ul class="list-unstyled ">
                <li>
                    <a href="dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>
                        主頁</a>
                </li>
                <li>
                    <a href="order-list.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                        </svg>
                        訂單管理</a>
                </li>
                <li>
                    <a href="product-list.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        商品管理</a>
                </li>
                <li>
                    <a href="category-list.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
                            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        分類管理</a>
                </li>
                <li>
                    <a href="user-list.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                        </svg>
                        使用者管理</a>
                </li>
                <li>
                    <a href="coupons.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                        </svg>
                        優惠券</a>
                </li>
                <li>
                    <a href="ratings.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                        </svg>
                        評價中心</a>
                </li>
                <li class="px-3 pb-1  d-flex justify-content-between fw-bold mt-2">
                    二手專區
                </li>
                <li>
                    <a href="used-product-list.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        商品管理</a>
                </li>
            </ul>
        </nav>
        <div class="time bg-info text-light pt-3 pb-1">
            <h6 id="time" class="text-center" style="font-size: 15px;"></h6>
        </div>
    </aside>

    <main class="main-content">
        <div class="d-flex justify-content-between mt-3">
            <h2>使用者管理</h2>
        </div>
        </div>
        <div class="container">
            <div class="py-2 d-flex justify-content-end">
                <a class="btn btn-primary me-2" href="sign-up-ui.php">新增會員</a>
                <a class="btn btn-primary" href="excel-user.php">Excel 表單</a>
            </div>
            <div class="py-2">
                <form action="user-list.php" method="get">
                    <div class="d-flex align-items-end">
                        <input type="text" class="form-control" name="search" value="<?php if (isset($search)) echo "$search"; ?>" placeholder="依帳號篩選">
                        <h6 class="text-nowrap mx-2">依註冊日期篩選</h6>
                        <input type="date" class="form-control" name="startdate" value="<?php if (isset($date1)) echo "$date1"; ?>">
                        <h6 class="mx-2">~</h6>
                        <input type="date" class="form-control" name="enddate" value="<?php if (isset($date2)) echo "$date2"; ?>">
                        <div class="input-group">
                            <select name="address" id="" class="form-select ms-2">
                                <option value="">依城市篩選</option>
                                <option value="台北市" <?php if (isset($address) && $address == "台北市") echo "selected" ?>>台北市</option>
                                <option value="新北市" <?php if (isset($address) && $address == "新北市") echo "selected" ?>>新北市</option>
                                <option value="台中市" <?php if (isset($address) && $address == "台中市") echo "selected" ?>>台中市</option>
                                <option value="台南市" <?php if (isset($address) && $address == "台南市") echo "selected" ?>>台南市</option>
                                <option value="桃園市" <?php if (isset($address) && $address == "桃園市") echo "selected" ?>>桃園市</option>
                            </select>
                            <select name="status" id="" class="form-select">
                                <option value="">依狀態篩選</option>
                                <option value="1" <?php if (isset($valid) && $valid == '1') echo "selected" ?>>使用中</option>
                                <option value="0" <?php if (isset($valid) && $valid == '0') echo "selected" ?>>已停權</option>
                            </select>
                            <button class="btn btn-primary" type="submit">送出</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="py-2 d-flex justify-content-between">
                <?php if (isset($search) && $search !== "") : ?>
                    <h6><?= $search ?>的搜尋結果</h6>
                <?php endif; ?>
                <?php if (isset($address) && $address !== "") : ?>
                    <h6><?= $address ?>的搜尋結果</h6>
                <?php endif; ?>
                <h6>共 <?= $userCount ?> 人</h6>
            </div>
            <table class="table table-bordered mt-3">
                <thead class="table-active">
                    <tr>
                        <th>編號</th>
                        <th>帳號</th>
                        <th>名稱</th>
                        <th>電話</th>
                        <th>狀態</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $person) : ?>
                        <tr>
                            <td><?= $person["id"] ?></td>
                            <td><?= $person["account"] ?></td>
                            <td><?= $person["name"] ?></td>
                            <td><?= $person["phone"] ?></td>
                            <td><?php if ($person["valid"] == 1) {
                                    echo "使用中";
                                } else {
                                    echo "已停權";
                                } ?></td>
                            <td><a href="user-detail.php?id=<?= $person["id"] ?>" class="btn btn-info">詳細資訊</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($i == $page) echo "active"; ?>"><a class="page-link" href="user-list.php?page=<?= $i ?>&search=<?php if (isset($search)) echo "$search"; ?>&startdate=<?php if (isset($date1)) echo "$date1"; ?>&enddate=<?php if (isset($date2)) echo "$date2"; ?>&address=<?php if (isset($address)) echo "$address"; ?>&status=<?php if (isset($valid)) echo "$valid"; ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php if (isset($search) || isset($address) || isset($valid) || isset($date1) || isset($date2)) : ?>
                <div>
                    <a href="user-list.php" class="btn btn-info">回全部會員列表</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script>
        let clockContent = document.querySelector("#time")

        function ticktick() {
            let today = new Date();

            let weekday = ["日", "一", "二", "三", "四", "五", "六"];
            let month = today.getMonth() + 1;
            let seconds = today.getSeconds()
            let minutes = today.getMinutes()
            let hours = today.getHours()
            if (seconds < 10) seconds = "0" + seconds
            if (minutes < 10) minutes = "0" + minutes
            if (hours < 10) hours = "0" + hours
            let now = today.getFullYear() + "/" + month + "/" + today.getDate() + "(" + weekday[today.getDay()] + ") " + hours + ":" + minutes + ":" + seconds;
            // console.log(now);
            clockContent.innerText = now;
        }

        ticktick();
        setInterval(ticktick, 1000)
    </script>

</body>

</html>