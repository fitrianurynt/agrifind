<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/profile/setting/general/<?= $user['id']; ?>">General</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profile/setting/account/<?= $user['id']; ?>">Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profile/setting/skill/<?= $user['id']; ?>">Skill and Compt.</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profile/setting/delete/<?= $user['id']; ?>">Delete</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>