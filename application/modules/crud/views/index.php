<div class="col-lg-pull-10">
    <span class="alert alert-info"><?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') : ''; ?></span>
    <a href="<?php echo base_url('crud/add') ?>" class="btn btn-primary">Add</a>
    <table class="table table-condensed">
        <thead>
        <th>S.N</th>
        <th>Username</th>
        <th>Email</th>
        <th>Group</th>
        <th>Actions</th>
        </thead>
        <tbody>
            <?php
            $sn = 1;
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td><?php echo $user->getGroup()->getName(); ?></td>
                    <td>[<a href="<?php echo base_url('crud/edit/' . $user->getId()); ?>">Edit</a>][<a href="<?php echo base_url('crud/delete/' . $user->getId()); ?>">Delete</a>]</td>
                </tr>
                <?php
                $sn++;
            }
            ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>