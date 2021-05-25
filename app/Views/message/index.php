<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5">
    <div class="col">
      <h1 class="mb-2">Message</h1>

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">From</th>
              <th scope="col">Subject</th>
              <th scope="col">Message</th>
              <th scope="col">Email</th>
              <th scope="col">Send</th>
              <th scope="col">-</th>
            </tr>
          </thead>
          <tbody>

            <!-- table content -->
            <?php $j = 1 ?>
            <?php for ($i=sizeof($message)-1; $i>=0; $i--) : ?>
              <tr>
                <td><?= $j++; ?></td>
                <td><a href="/profile/view/<?= $sender[$i]->id; ?>"><?= $sender[$i]->name; ?></a></td>
                <td><?= $message[$i]['subject']; ?></td>
                <td><?= $message[$i]['message']; ?></td>
                <td><a href="mailto:<?= $sender[$i]->email; ?>"><?= $sender[$i]->email; ?></a></td>
                <td><?= date('d-M H:i', strtotime($message[$i]['created_at'])) ?></td>
                <td><a class="btn btn-danger" href="/message/deleteMessage/<?= $message[$i]['id']; ?>">Delete</a></td>
              </tr>
            <?php endfor; ?>
            </tr>
          </tbody>
        </table>



    </div>
  </div>
</div>

<?= $this->endSection(); ?>