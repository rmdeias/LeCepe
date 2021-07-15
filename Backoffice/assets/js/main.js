
$(document).ready(function()
{
    $(".delete").click(function(e)
    {
        e.preventDefault();
        let demande = confirm( "Voulez vous vraiment supprimmer ces informations" );
        if(!demande) {
            e.preventDefault();  
        }
        else{
            window.location = this.href;
        }
    }); 
});
