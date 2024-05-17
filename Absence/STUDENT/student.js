document.addEventListener("DOMContentLoaded", function() 
{
    document.getElementById("codeGroup").style.display = "none";

    document.querySelectorAll('input[type="radio"]').forEach(function(radio) 
    {
        radio.addEventListener("change", function() 
        {
            if (this.value === "No") 
            {
                document.getElementById("codeGroup").style.display = "none";
                document.getElementById("code").removeAttribute("required");
            } else 
                {
                    document.getElementById("codeGroup").style.display = "block";
                    document.getElementById("code").setAttribute("required", "required");
                }
        });
    });
    setTimeout(function() 
        {
            document.getElementById("code").disabled = true;
        }, 30000);

    document.getElementById("presenceForm").addEventListener("submit", function() 
    {
        console.log("Form submitted");
        window.location.href = "../signin";
    });
});