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
		var a = document.getElementById('bankdr').value;
		var b = document.getElementById('chqdr').value;
		var x = document.getElementById('descdr').value;
		var y = document.getElementById('selectdr').value;
		var z = document.getElementById('AmountDr').value;
	    if (y == "") {
	        alert("Please select a Debit Account");
	        return;
	    }
	    else if(x == ""){
	    alert("Please enter Description");
	    return;}
	    else if((y=="6")||(y=="7")){ 
	    if(a==""){
	    	alert("Please enter Bank Name");
	        return;
	    }
	    else if (b==""){
	    	alert("Please enter Cheque Number");
	        return;
	    }
	    else if (z == "") {
	        alert("Please enter Amount");
	        return;
	    }}
	    else if (z == "") {
	        alert("Please enter Amount");
	        return;
	    }
	    amountDTotal();
		equate();
		var DrTitle= document.getElementById('selectdr').options[document.getElementById('selectdr').selectedIndex].text;
		//document.getElementById('Result_Dr').innerHTML = DrTitle;
								
		var AmountDr = document.getElementById('AmountDr').value;	
		//document.getElementById('Result_AmtDr').innerHTML =Amount;
		var DescDr = document.getElementById('descdr').value;
		var BankDr = document.getElementById('bankdr').value;
		var ChqDr = document.getElementById('chqdr').value;
		var DebitTable = document.getElementById("DebitTable");
		var row = DebitTable.insertRow(-1);
		
		
		
			var Result_Dr = row.insertCell(0);
				var debit_name_input = document.createElement('input');
				debit_name_input.type='hidden';
				debit_name_input.name='drnames[]';
				debit_name_input.value=DrTitle;
				Result_Dr.innerHTML = DrTitle;
				Result_Dr.appendChild(debit_name_input);

			var Desc_Dr = row.insertCell(1);
				var debit_desc_input = document.createElement('input');
				debit_desc_input.type='hidden';
				debit_desc_input.name='drdesc[]';
				debit_desc_input.value=DescDr;
				if((y=="6")||(y=="7")){
				Desc_Dr.innerHTML = DescDr+"<br>("+ChqDr+") "+BankDr;}
				else{
				Desc_Dr.innerHTML = DescDr;
				}
				Desc_Dr.appendChild(debit_desc_input);
		
			var Result_AmtDr = row.insertCell(2);
				var debit_value_input = document.createElement('input');
				debit_value_input.type='hidden';
				debit_value_input.name='drvalues[]';
				debit_value_input.value=AmountDr;
				Result_AmtDr.innerHTML = AmountDr;
				Result_AmtDr.appendChild(debit_value_input);
	
				
			var DelDr = row.insertCell(3);
				DelDr.innerHTML = "<button type='button' value="+AmountDr+" class='btn bg-maroon btn-xs fa fa-trash' onclick='deleteDr(this)'></button>"

			var Result_BankDr = row.insertCell(4);
				var debit_bank_input = document.createElement('input');
				debit_bank_input.type='hidden';
				debit_bank_input.name='drbank[]';
				debit_bank_input.value=BankDr;
				Result_BankDr.appendChild(debit_bank_input);

			var Result_ChqDr = row.insertCell(5);
				var debit_chq_input = document.createElement('input');
				debit_chq_input.type='hidden';
				debit_chq_input.name='drchq[]';
				debit_chq_input.value=ChqDr;
				Result_ChqDr.appendChild(debit_chq_input);
		
		return false;
	}
	
	
						
	function Cr(){
		var a = document.getElementById('bankcr').value;
		var b = document.getElementById('chqcr').value;
		var x = document.getElementById('desccr').value;
		var y = document.getElementById('selectcr').value;
		var z = document.getElementById('AmountCr').value;
	    if (y == "") {
	        alert("Please select a Debit Account");
	        return;
	    }
	    else if(x == ""){
	    alert("Please enter Description");
	    return;}
	    else if((y=="6")||(y=="7")){ 
	    if(a==""){
	    	alert("Please enter Bank Name");
	        return;
	    }
	    else if (b==""){
	    	alert("Please enter Cheque Number");
	        return;
	    }
	    else if (z == "") {
	        alert("Please enter Amount");
	        return;
	    }}
	    else if (z == "") {
	        alert("Please enter Amount");
	        return;
	    }
	    amountCTotal();
		equate();
		var CrTitle= document.getElementById('selectcr').options[document.getElementById('selectcr').selectedIndex].text;
		var DescCr = document.getElementById('desccr').value;
		var BankCr = document.getElementById('bankcr').value;
		var ChqCr = document.getElementById('chqcr').value;				
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

			var Desc_Cr = row.insertCell(1);
				var credit_desc_input = document.createElement('input');
				var credit_bank_input = document.createElement('input');
				var credit_chq_input = document.createElement('input');
				credit_desc_input.type='hidden';
				credit_desc_input.name='crdesc[]';
				credit_desc_input.value=DescCr;
				credit_bank_input.type='hidden';
				credit_bank_input.name='crbank[]';
				credit_bank_input.value=BankCr;
				credit_chq_input.type='hidden';
				credit_chq_input.name='crchq[]';
				credit_chq_input.value=ChqCr;
				if((y=="6")||(y=="7")){
				Desc_Cr.innerHTML = DescCr+"<br>("+ChqCr+") "+BankCr;}
				else{
				Desc_Cr.innerHTML = DescCr;
				}
				Desc_Cr.appendChild(credit_desc_input);
				
			var Result_AmtCr= row.insertCell(2);
				var credit_value_input = document.createElement('input');
				credit_value_input .type='hidden';
				credit_value_input.name='crvalues[]';
				credit_value_input .value=AmountCr;
				Result_AmtCr.innerHTML = AmountCr;
				Result_AmtCr.appendChild(credit_value_input);
		
			var DelCr = row.insertCell(3);
			DelCr.innerHTML = "<button type='button' value="+AmountCr+" class='btn bg-maroon btn-xs fa fa-trash' onclick='deleteCr(this)'></button>"
		
			var Result_BankCr = row.insertCell(4);
				var debit_bank_input = document.createElement('input');
				credit_bank_input.type='hidden';
				credit_bank_input.name='crbank[]';
				credit_bank_input.value=BankCr;
				Result_BankCr.appendChild(credit_bank_input);

			var Result_ChqCr = row.insertCell(5);
				var credit_chq_input = document.createElement('input');
				credit_chq_input.type='hidden';
				credit_chq_input.name='crchq[]';
				credit_chq_input.value=ChqCr;
				Result_ChqCr.appendChild(credit_chq_input);
				
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
	
