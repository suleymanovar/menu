/**
 * Created by Администратор on 09.08.2016.
 */
function received(ingr)
{
 if (ingr.length<2) {alert("выберите еще один ингредиент");return;}
   
        $.pjax.reload({container:"#grid-arrival",data:{ingr:ingr}, replace: false});

}

function deleteConsist(id)
{
 if (confirm("Вы точно хотите удалить?"))
   $.get('delete-consist', {id:id},function(){
       $.pjax.reload({container:"#grid-arrival",replace: false});
    });
        

}
