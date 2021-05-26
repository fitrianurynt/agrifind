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
            
            <th scope="col">Subject</th>
            <th scope="col">Send</th>
            <th scope="col">From</th>

            <th scope="col">-</th>
          </tr>
        </thead>
        <tbody>

          <!-- table content -->
          <?php $j = 1 ?>
          <?php foreach (array_reverse($sender) as $m) : ?>
            <tr>
              <td><?= $j++; ?></td>

              <td data-bs-toggle="modal" data-bs-target="#messageDesc<?= $m['message_id'] ?>"><b><?= $m['subject']; ?></b></td>
              <td data-bs-toggle="modal" data-bs-target="#messageDesc<?= $m['message_id'] ?>"><?= date('d-M H:i', strtotime($m['created_at'])) ?></td>
              <td onclick="window.location='/profile/view/<?= $m['id']; ?>'"><?= $m['name']; ?></td>
                            
              <td><a class="badge bg-danger" href="/message/deleteMessage/<?= $m['id']; ?>">Delete</a></td>
            </tr>

            <div class="modal fade" id="messageDesc<?= $m['message_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <?= $m['subject'] ?></h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <p>From : <?= $m['name'] ?></p>
                    <?= $m['message'] ?>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          </tr>
        </tbody>
      </table>



    </div>
  </div>
</div>


<?= $this->endSection(); ?>