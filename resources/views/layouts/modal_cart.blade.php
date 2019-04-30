<div class="modal" id="order" tabindex="-1" role="dialog" aria-labelledby="modal_product_name"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 20px;margin: auto;">
      <form class="form_order">
        <input class="input"  id="hidden_quantity" type="hidden" disabled="" value="1">
        <input type="hidden" name="product" id="product_id_modal" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h2 class="modal-title"></h2>
          <h3 style="margin:3% 0">Size</h3>
          <?php $sizes = array('XS', 'S','M','XL','XXL'); ?>
          @foreach($sizes as $key => $size)
          <label style="padding: 2px 15px;margin-left: 5px;border-radius: 15px;font-size: 20px;background-color: #FF7F50">
          <input type="radio" @if($key==0) checked @else "" @endif name="size" value="{{ $size }}">{{ $size }}
          </label>
          @endforeach
          <?php $colors = array('Đỏ', 'Trắng','Vàng','Xanh','Đen'); ?>
          <h3 style="margin:3% 0">Màu sắc</h3>
          @foreach($colors as $key => $color)
         <label style="padding: 2px 15px;margin-left: 5px;border-radius: 15px;font-size: 20px;background-color: #ADFF2F">
          <input type="radio" @if($key==0) checked @else "" @endif name="color" value="{{ $color }}">{{ $color }}
          </label>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="submit" id="btnSubmitOrder" class="btn btn-primary btnSubmitOrder">Đặt hàng</button>
          <button type="button" data-dismiss="modal" class="btn btn-danger">Hủy bỏ</button>
        </div>
      </form>
    </div>
  </div>
</div>
