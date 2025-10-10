<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center mt-3 mb-3">All members(<?= count($members); ?>)</h4>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Report subject</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><img width="55" height="55" src="public/img/<?= $member['photo_name'] ?>" alt="avatar"></td>
                        <td><?= $member['first_name'] . ' ' . $member['last_name'] ?></td>
                        <td><?= $member['report_subject'] ?></td>
                        <td><a href="mailto: <?= $member['email'] ?>"><?= $member['email'] ?></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
