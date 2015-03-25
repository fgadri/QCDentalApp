<!--container start-->
<div class="component-bg pad-bot-fifty">
    <div class="container">
        <div id="company-<?php echo $company['id']; ?>">
            <h3><?php echo $company['name']; ?></h3>
            <table class="table-striped table-condensed table-responsive table-hover">
                <thead>
                    <tr class="col-md-12">
                        <th class="user-checkbox col-md-1"></th>
                        <th class="user-checkbox col-md-3">Username</th>
                        <th class="user-checkbox col-md-4">Name</th>
                        <th class="user-checkbox col-md-4">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($company['users'] as $user) : ?>
                        <tr class="col-md-12">
                            <td>
                                <input type="checkbox" name="users[]" value="<?php echo $company['id'] . '-' . $user['id']; ?>" />
                            </td>
                            <td>
                                <span><?php echo $user['username']; ?></span>
                            </td>
                            <td>
                                <span><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></span>
                            </td>
                            <td>
                                <span><?php echo $user['email']; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--container end-->
