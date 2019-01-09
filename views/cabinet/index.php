<?php include(ROOT . '/views/layouts/header.php'); ?>

    <main>
        <div class="container rad" id="TopMargin">
            <h1>Кабинет пользователя</h1>
            <hr class="divider">

            <h4>Добро пожаловать, <?php echo $user['FirstName'] . ' ' . $user['Patronymic']; ?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
            </ul>
        </div>
        <div class="container rad">
            <h2>История заказов</h2>
            <hr class="divider">
            <?php if (!isset($odersList) || count($odersList) === 0): ?>
                <div class="alert alert-danger">
                    <p>Отсутсвуют записи для текущего пользователя</p>
                </div>
            <?php else: ?>
            <table class="table table-bordered" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th scope="col">№ заказа</th>
                    <th scope="col">Название модели</th>
                    <th scope="col">КППП</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата покупки</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($row = 0; $row < count($odersList); $row++): ?>
                    <tr>
                        <td><?php echo $odersList[$row]['TabNo']?></td>
                        <td><a href="/models/<?php echo $odersList[$row]['Mod'].'/'.$odersList[$row]['Sub']; ?>"><?php echo $odersList[$row]['ModelName']?></a></td>
                        <td><?php echo $odersList[$row]['Transmission']?></td>
                        <td><?php echo $odersList[$row]['Price']?> руб.</td>
                        <td><?php echo $odersList[$row]['purchaseStatus']?></td>
                        <td><?php echo $odersList[$row]['PurchaseDate']?></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </main>

<?php include(ROOT . '/views/layouts/footer.php'); ?>