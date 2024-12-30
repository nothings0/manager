<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - Learning PHP</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <style>
      :root {
        --header: 70px;
        --footer: 56px;
      }
      main {
        display: flex;
        flex-wrap: nowrap;
        min-height: 100vh;
        overflow-x: auto;
        overflow-y: hidden;
      }
      .navbar {
        display: flex;
        justify-content: flex-end;
        background: #f8f9fa;
        margin: 0 -0.75rem;
        padding: 1rem;
      }
      .wrap{
        min-height: calc(100vh - var(--header));
        padding: 1rem;
      }
      footer {
        display: flex;
        justify-content: center;
        background: #f8f9fa;
        margin: 0 -0.75rem;
        padding: 1rem;
      }
    </style>
  </head>

  <body>
    <main>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 150px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4 fw-bold">XManager</span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
        <a href="/" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/') ? 'active' : 'link-dark'; ?>">
                Khách hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/product" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/product') === 0) ? 'active' : 'link-dark'; ?>">
                Mặt hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/category" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/category') === 0) ? 'active' : 'link-dark'; ?>">
                Loại hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/employee" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/employee') === 0) ? 'active' : 'link-dark'; ?>">
                Nhân viên
            </a>
        </li>
    </ul>
</div>

      <div style="width: 100%">
          <nav class="navbar">
            <?php if (isset($_SESSION['currentUser'])): ?>
            <!-- Nếu có currentUser, hiển thị icon user -->
            <div class="dropdown">
              <a
                href="#"
                class="d-flex align-items-center text-decoration-none dropdown-toggle"
                id="userDropdown"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  src="/public/images/user.png"
                  alt="User Icon"
                  style="width: 30px; height: 30px; border-radius: 50%"
                />
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="userDropdown"
              >
                <li><a class="dropdown-item" href="/account">Tài khoản</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <form
                    action="/auth/logout"
                    method="post"
                    style="display: inline"
                  >
                    <button type="submit" class="dropdown-item btn btn-danger">
                      Đăng xuất
                    </button>
                  </form>
                </li>
              </ul>
            </div>

            <?php else: ?>
            <!-- Nếu không có currentUser, hiển thị nút đăng nhập -->
            <a class="btn btn-primary" href="/auth/login">Đăng nhập</a>
            <?php endif; ?>
          </nav>
          <div class="wrap">

          <?= $content ?>
          
        </div>
        <footer>
            <strong>Copyright &copy; 2024 <a href="#">XTeam</a>.</strong>
            All rights reserved.
          </footer>
      </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: "textarea",
      });
      document.querySelectorAll(".input-format").forEach((input) => {
        // Định dạng khi người dùng nhập vào ô
        input.addEventListener("input", function () {
          formatNumber(this);
        });

        // Định dạng khi trang được tải (để hiển thị giá trị ban đầu đã format)
        formatNumber(input);
      });

      function formatNumber(input) {
        // Lấy giá trị của input, loại bỏ các ký tự không phải là số
        let value = input.value.replace(/\D/g, "");
        if (value) {
          // Định dạng số với dấu phân cách hàng nghìn
          value = parseInt(value).toLocaleString("en");
        }
        input.value = value; // Cập nhật lại giá trị vào ô input
      }
    </script>
  </body>
</html>
