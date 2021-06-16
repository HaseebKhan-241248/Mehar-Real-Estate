
function getSectors(val)
{
    $('#sectors').html('');
    $('#sectors').append('');
    $.ajax({
        url:`${baseurl}/get_sectors/${val}`,
        method:'GET',
        success: function (response) {
            console.log('response flat_id');
            console.log(response);
            $('#sectors').append('<option value="">Select One</option>');
            response.data.map(function (data){
                let  html = '<option value="'+ data.id +'">'+data.name+'</option>'
                $('#sectors').append(html);
            });
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}

function getSectorsedit(val,count)
{
    $('#sectors'+count).html('');
    $('#sectors'+count).append('');
    $.ajax({
        url:`${baseurl}/get_sectors/${val}`,
        method:'GET',
        success: function (response) {
            console.log('response flat_id');
            console.log(response);
            $('#sectors'+count).append('<option value="">Select Sector</option>');
            response.data.map(function (data){
                let  html = '<option value="'+ data.id +'">'+data.name+'</option>'
                $('#sectors'+count).append(html);
            });
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}

function getBlocks(val)
{
    $('#block_id').html('');
    $('#block_id').append('');
    $.ajax({
        url:`${baseurl}/get_blocks/${val}`,
        method:'GET',

        success: function (response) {
            $('#block_id').append('<option value="">Select One</option>');
            response.data.map(function (data){
                let  html = '<option value="'+ data.id +'">'+data.name+'</option>'
                $('#block_id').append(html);
            });
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}

function getBlocksedit(val,count)
{
    $('#block_id'+count).html('');
    $('#block_id'+count).append('');
    $.ajax({
        url:`${baseurl}/get_blocks/${val}`,
        method:'GET',

        success: function (response) {
            $('#block_id'+count).append('<option value="">Select One</option>');
            response.data.map(function (data){
                let  html = '<option value="'+ data.id +'">'+data.name+'</option>'
                $('#block_id'+count).append(html);
            });
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}

function getPlots(block_id)
{
    $('#plot_id').html('');
    $('#plot_id').append('');
    $.ajax({
        url:`${baseurl}/get_plots/${block_id}`,
        method:'GET',
        success: function (response)
        {
            $('#plot_id').append('<option value="">Select Plot</option>');
            response.data.map(function (data)
            {
                let  html = '<option value="'+ data.id +'">'+data.name+'</option>'
                $('#plot_id').append(html);
            });
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}
function getPlotMarla(val)
{
    $('#size').val('');
    $.ajax({
        url:`${baseurl}/get_plot_marla/${val}`,
        method:'GET',
        success: function (response)
        {
            let res = response.split("**");
            // alert(response);
            $('#size').val(res[0]);
            $('#size_name').val(res[1]);
        },
        error: function (error) {
            console.log('error');
            console.log(error);
        }
    })
}
var row=1;
$(document).on("click", "#add-row", function () {
    var new_row = `
      <tr id="row${row}">
       <td>
       <div class="col-md-12 input-group input-group-sm xs-mb-15">
         <input name="attachments[]" type="file" class="form-control" />
         </div>
       </td>
       <td>
       <div class="col-md-12 input-group input-group-sm xs-mb-15">
        <input name="comments[]" type="text" placeholder="Comment" class="form-control" />
        </div>
       </td>
       <td>
         <button class="delete-rowatt btn btn-danger btn-sm">
            <i class="fa fa-trash  text-white"></i>
         </button>
       </td>
      </tr>
    `;

    $('#test-body').append(new_row);
    row++;
    return false;
});

// Remove criterion
$(document).on("click", ".delete-rowatt", function () {
    //  alert("deleting row#"+row);
    if(row>1) {
        $(this).closest('tr').remove();
        row--;
    }
    return false;
});
