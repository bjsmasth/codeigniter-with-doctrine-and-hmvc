<div class="col-lg-pull-10">
    <form name="user" method="post" action="<?php echo base_url('crud/edit/' . $user->getId()); ?>">
        <input type="hidden" name="hidden_id" value="<?php echo $user->getId(); ?>">
        <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?php echo set_value('username') ? set_value('username') : $user->getUsername(); ?>">
            <?php echo form_error('username'); ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter E-mail" value="<?php echo set_value('email') ? set_value('email') : $user->getEmail(); ?>">
            <?php echo form_error('email'); ?>
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <select name="group">
                <option value="">Select Group</option>
                <?php foreach ($usergroups as $usergroup) { ?>
                    <option value="<?php echo $usergroup->getID(); ?>" <?php echo set_value('group') ? (set_value('group') == $usergroup->getID()) ? 'selected' : '' : ($usergroup == $user->getGroup()) ? 'selected' : ''; ?>><?php echo $usergroup->getName(); ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('group'); ?>
        </div>
        <input type="submit" class="btn btn-default" name="submitBtn" value="Submit">
    </form>
</div>