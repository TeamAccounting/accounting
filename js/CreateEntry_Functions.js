	 function createEntry(){
            $('#modal_createentry').modal('show');	
        }

// validation		
function isNumberKey(evt){

	
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
			return false;
		return true;
}

function change(evt){
	evt.value = parseFloat(evt.value).toFixed(2);
}
	
	
function noSpecialChar(evt){
	var checkCode = (evt.which) ? evt.which : event.keyCode
	if((checkCode==8)||(checkCode==32)||(checkCode>=48 && checkCode<=57)||(checkCode>=65 && checkCode<=90)||(checkCode>=97 && checkCode<=122))
            return true;
		return false;
		}
		
	
// dr and cr functions	
	function Dr(){
		var x = document.getElementById('descdr').value;
		var y = document.getElementById('selectdr').value;
		var z = document.getElementById('AmountDr').value;
		if (document.getElementById('descdr').disabled){
	    }else{
	    	 if (x == "") {
	        alert("Please enter Description");
	        return;
	    }}
	    if (y == "") {
	        alert("Please select a Debit Account");
	        return;
	    }
	     else if (z == "") {
	        alert("Please enter Amount");
	        return;
	    }
	    amountDTotal();
		equate();
		var DrTitle= document.getElementById('selectdr').value;
		//document.getElementById('Result_Dr').innerHTML = DrTitle;
								
		var AmountDr = document.getElementById('AmountDr').value;	
		//document.getElementById('Result_AmtDr').innerHTML =Amount;
		var DebitTable = document.getElementById("DebitTable");
		var row = DebitTable.insertRow(-1);
		
		
		
			var Result_Dr = row.insertCell(0);
				var debit_name_input = document.createElement('input');
				debit_name_input.type='hidden';
				debit_name_input.name='drnames[]';
				debit_name_input.value=DrTitle;
				Result_Dr.innerHTML = DrTitle;
				Result_Dr.appendChild(debit_name_input);
		
		
			var Result_AmtDr = row.insertCell(1);
				var debit_value_input = document.createElement('input');
				debit_value_input.type='hidden';
				debit_value_input.name='drvalues[]';
				debit_value_input.value=AmountDr;
				Result_AmtDr.innerHTML = AmountDr;
				Result_AmtDr.appendChild(debit_value_input);
	
				
			var DelDr = row.insertCell(2);
				DelDr.innerHTML = "<button type='button' value="+AmountDr+" class='btn bg-maroon btn-xs fa fa-trash' onclick='deleteDr(this)'></button>"
			
		return false;
	}
	
	
						
	function Cr(){
			
		amountCTotal() ;
		equate();
		
		var CrTitle= document.getElementById('selectcr').value;					
		var AmountCr = document.getElementById('AmountCr').value;	
		var CreditTable = document.getElementById("CreditTable");
		var row = CreditTable.insertRow(-1);
		
			var Result_Cr = row.insertCell(0);
				var credit_name_input = document.createElement('input');
				credit_name_input.type='hidden';
				credit_name_input.name='crnames[]';
				credit_name_input.value=CrTitle;
				Result_Cr.innerHTML = CrTitle;
				Result_Cr.appendChild(credit_name_input);
				
			var Result_AmtCr= row.insertCell(1);
				var credit_value_input = document.createElement('input');
				credit_value_input .type='hidden';
				credit_value_input.name='crvalues[]';
				credit_value_input .value=AmountCr;
				Result_AmtCr.innerHTML = AmountCr;
				Result_AmtCr.appendChild(credit_value_input);
		
		var DelCr = row.insertCell(2);
		DelCr.innerHTML = "<button type='button' value="+AmountCr+" class='btn bg-maroon btn-xs fa fa-trash' onclick='deleteCr(this)'></button>"
		
	
				
		return false;
	}
	
	
function amountDTotal() {
	
	
   var numbers = parseFloat(document.getElementById('AmountDr').value);
   var total = parseFloat(document.getElementById('debit_total').value);
	total = total +numbers;
   document.getElementById('debit_total').value = total;
   equate();
  
}

function amountCTotal() {
	
   var numbers = parseFloat(document.getElementById('AmountCr').value);
  document.getElementById('credit_total').value = parseFloat(document.getElementById('credit_total').value) + numbers;
  equate();
  
}
	
	function deleteDr(r){
		
		    var i = r.parentNode.parentNode.rowIndex;
			document.getElementById("DebitTable").deleteRow(i);
			var mis = parseFloat(r.value);
		
			document.getElementById('debit_total').value = parseFloat(document.getElementById('debit_total').value) - mis;
		equate();
	}
	
	
	function deleteCr(r){
		
		    var i = r.parentNode.parentNode.rowIndex;
			document.getElementById("CreditTable").deleteRow(i);
			var mis = parseFloat(r.value);
			
			document.getElementById('credit_total').value = parseFloat(document.getElementById('credit_total').value) - mis;
		equate();
	}
	
	
	function clearTable(){
		var tableHeaderRowCount = 1;
		var table = document.getElementById('DebitTable');
		var rowCount = table.rows.length;
			for (var i = tableHeaderRowCount; i < rowCount; i++) {
				table.deleteRow(tableHeaderRowCount);
			}

		var table = document.getElementById('CreditTable');
		var rowCount = table.rows.length;
			for (var i = tableHeaderRowCount; i < rowCount; i++) {
				table.deleteRow(tableHeaderRowCount);
			}
			
			dr_id=1;
			cr_id=1;
			document.getElementById('AmountDr').value = "";
			document.getElementById('AmountCr').value = "";
			document.getElementById('credit_total').value = 0;
			document.getElementById('debit_total').value = 0;

		var pass = document.getElementById('pass');
			pass.disabled = true;
			
	}
	
	function equate(){
		var debit_total = parseFloat(document.getElementById('debit_total').value);
		var credit_total = parseFloat(document.getElementById('credit_total').value);
		var pass = document.getElementById('pass')
		
		if( debit_total != credit_total){
			pass.disabled = true;
		}else{
			pass.removeAttribute('disabled');
		}
		
	}
	
