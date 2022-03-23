<div id="htmlContent">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header custom-card-header">
          <h4>View User</h4>
          <a href="#" class="btn btn-secondary" type="button" name="button" style="position: absolute;right: 20px;" onclick="getData('user-index');"><i class="fas fa-plus"></i> Add User</a>
        </div>
        <div class="card-body">
          <div class="row" style="align-items: center; margin: 2rem 0rem;">
            <div class="col-sm-12 col-md-6">
              <div class="input-group" style="align-items: center;">
                Show
                <div class="col col-sm-3">
                  <select name="order-listing_length" aria-controls="order-listing" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                  </select>
                </div>
                entries
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <form class="row pull-right" action="https://admin-rentroom.rentcubo.info/admin/users/index" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control table-btn-group" name="search_key" value="" placeholder="Search by User Name,Email Id" required="">
                    <span>
                      <button type="submit" class="btn btn-secondary table-btn-group">
                        <span><i class="fa fa-search" aria-hidden="true"></i></span>
                      </button>
                      <a href="https://admin-rentroom.rentcubo.info/admin/users/index" class="btn btn-secondary table-btn-group">
                        <span> <i class="fa fa-eraser" aria-hidden="true"></i></span>
                      </a>
                    </span>
                </div>

              </div>
          </div>
          <div id="vmap" class="vmap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" id="contentScript">
</script>
