@extends('admin.layouts.app')
@section('panel')
<style>
    .eth_balance_loader, .erc_balance_loader {
        display:none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <table class='table'>
                    <tr>
                        <td>
                            <button class='btn btn-primary' id="withraw_eth">Withdraw ETH</button>
                            <button class='btn btn-primary' id="eth_total_balance">View Total Balance</button>&nbsp;
                            <strong id="eth_total_amount"></strong>
                            <button class='btn btn-primary' id="eth_withrawable_balance">View Withrawable Balance</button>&nbsp;
                            <strong id="eth_withrawable_amount"></strong>
                            <img src="{{ asset('assets/admin/images/loading.gif') }}" alt="Loading..." width="30" height="30" class="eth_balance_loader"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class='btn btn-primary' id="withraw_unic">Withdraw UNIC</button>
                            <button class='btn btn-primary' id="erc_total_balance">View Total Balance</button>&nbsp;
                            <strong id="erc_total_amount"></strong>
                            <button class='btn btn-primary' id="erc_withrawable_balance">View Withrawable Balance</button>&nbsp;
                            <strong id="erc_withrawable_amount"></strong>
                            <img src="{{ asset('assets/admin/images/loading.gif') }}" alt="Loading..." width="30" height="30" class="erc_balance_loader"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('assets/admin/js/notify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script>
    var eth_total_balance = 0;
    var erc_total_balance = 0;
    var eth_withrawable_balance = 0;
    var erc_withrawable_balance = 0;
    var accounts;
    var networkId = 0;
    var smartContractAddress = "{{config('app.smart_contract_address')}}";
    var tokenSmartContractAddress = "{{config('app.token_smart_contract_address')}}";
    var ownerAddress = "{{config('app.owner_address')}}";
    var ropesticNetworkId = "{{config('app.network_id')}}";
    var gasLimit = "{{config('app.gasLimit')}}";
    $(function() {
        $(document).on("click","#eth_total_balance",function() {
            if(eth_total_balance == 0) {
                loadMetamask("ETH","T");    
            } else {
                $.notify("Please wait...process is running", "error");
            }
        });
        
        $(document).on("click","#eth_withrawable_balance",function() {
            if(eth_withrawable_balance == 0) {
                loadMetamask("ETH","W");    
            } else {
                $.notify("Please wait...process is running", "error");
            }
        });
        
        $(document).on("click","#erc_total_balance",function() {
            if(erc_total_balance == 0) {
                loadMetamask("UNIC","T");    
            } else {
                $.notify("Please wait...process is running", "error");
            }
        });
        
        $(document).on("click","#erc_withrawable_balance",function() {
            if(erc_withrawable_balance == 0) {
                loadMetamask("UNIC","W");    
            } else {
                $.notify("Please wait...process is running", "error");
            }
        });
        
        $(document).on("click","#withraw_eth",function() {
            if(eth_withrawable_balance > 0) {
                 withdrawEth();   
            } else {
                $.notify("Sorry you can't withraw, balance is 0.", "error");
            }
        });
        
        $(document).on("click","#withraw_unic",function() {
            alert(erc_withrawable_balance);
            if(erc_withrawable_balance > 0) {
                withdrawERC();   
            } else {
                $.notify("Sorry you can't withraw, balance is 0.", "error");
            }
        });
    
    });
    
    async function loadMetamask(type,type2) {
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                accounts = await requestForAccessAccount();
                if( ownerAddress.toLowerCase() == accounts[0].toString().toLowerCase()) {
                    networkId = await requestForAccessNetwork();
                    if( networkId+"" == ropesticNetworkId ) {
                        window.contract = await loadContract();
                        console.log(window.contract);
                        if(window.contract) {
                            if(type == "ETH") {
                               if(type2 == "T") {
                                    eth_total_balance = await balanceOf(); 
                                    console.log(eth_total_balance);
                                    if(eth_total_balance>=0) {
                                       eth_total_balance = window.web3.utils.fromWei(eth_total_balance.toString(), 'ether');
                                        $("#eth_total_amount").text(eth_total_balance+" (ETH)");
                                    } else {
                                        $("#eth_total_amount").text("0 (ETH)");
                                    }
                                    $("#eth_total_balance").hide();
                               } else {
                                    eth_withrawable_balance = await ethBalance(); 
                                    if(eth_withrawable_balance>=0) {
                                       eth_withrawable_balance = window.web3.utils.fromWei(eth_withrawable_balance.toString(), 'ether');
                                        $("#eth_withrawable_amount").text(eth_withrawable_balance+" (ETH)");
                                    } else {
                                        $("#eth_withrawable_amount").text("0 (ETH)");
                                    }
                                    $("#eth_withrawable_balance").hide();
                               }
                               $(".eth_balance_loader").hide();
                            } else {
                                if(type2 == "T") {
                                    erc_total_balance = await erc20TotalBalance(); 
                                    erc_total_balance = window.web3.utils.fromWei(erc_total_balance.toString());
                                    if(erc_total_balance>=0) {
                                        $("#erc_total_amount").text(erc_total_balance+" (UNIC)");
                                    } else {
                                        $("#erc_total_amount").text("0 (UNIC)");
                                    }
                                    $("#erc_total_balance").hide();
                               } else {
                                    erc_withrawable_balance = await erc20Balance(); 
                                    erc_withrawable_balance = window.web3.utils.fromWei(erc_withrawable_balance.toString());
                                    if(erc_withrawable_balance>=0) {
                                        $("#erc_withrawable_amount").text(erc_withrawable_balance+" (UNIC)");
                                    } else {
                                        $("#erc_withrawable_amount").text("0 (UNIC)");
                                    }
                                    $("#erc_withrawable_balance").hide();
                               }
                               $(".erc_balance_loader").hide();
                            }
                        } else {
                            $.notify("Smart Contract instance is not valid", "error");
                        }
                    } else {
                        $.notify("Please choose Ropestic Network from metamask", "error");
                    }
                } else {
                    $.notify("Please choose owner account from metamask.", "error");
                }
                
            } catch (error) {
                // User denied account access...
                console.log(error);
            }
        } else if (window.web3) { // Legacy dapp browsers...
            console.log('Legacy dapp browsers...');
            window.web3 = new Web3(web3.currentProvider);
        } else { // Non-dapp browsers...
            $.notify("Browser has not Metamask extension, please add Metamask extension in your brawser.", "error");
        }
    }
    
    async function requestForAccessAccount() {
        if (typeof window.ethereum !== 'undefined') {
            return await window.ethereum.request({method: 'eth_requestAccounts'});
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function requestForAccessNetwork() {
        if (typeof window.ethereum !== 'undefined') {
            return await window.ethereum.request({method: 'net_version'});
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function loadContract() {
        var abi = await $.getJSON("{{ asset('assets/contract/eth_abi.json') }}");
        console.log(smartContractAddress);
        console.log(abi);
        return await new  window.web3.eth.Contract(abi,smartContractAddress);
    }
    
    async function balanceOf() {
        $(".eth_balance_loader").show();
        try {
           return await window.contract.methods.balanceOf().call({from:ownerAddress.toLowerCase()});  
        } catch (error) {
            $(".eth_balance_loader").hide();
            $.notify("Eth total balance not found.", "error");
            console.log("Eth total Error Code:");
            console.log(error);
        }
    }
    
    async function ethBalance() {
        $(".eth_balance_loader").show();
        try {
           return await window.contract.methods.ethBalance().call({from:ownerAddress.toLowerCase()});  
        } catch (error) {
            $(".eth_balance_loader").hide();
            $.notify("Eth Withrawable balance not found.", "error");
            console.log("Eth Withrawable Error Code:");
            console.log(error);
        }
    }
    
    async function erc20TotalBalance() {
        $(".erc_balance_loader").show();
        try {
           return await window.contract.methods.erc20TotalBalance(tokenSmartContractAddress,smartContractAddress).call({from:ownerAddress.toLowerCase()});  
        } catch (error) {
            $(".erc_balance_loader").hide();
            $.notify("ERC total balance not found.", "error");
            console.log("ERC total Error Code:");
            console.log(error);
        }
    }
    
    async function erc20Balance() {
        $(".erc_balance_loader").show();
        try {
           return await window.contract.methods.erc20Balance(tokenSmartContractAddress,smartContractAddress).call({from:ownerAddress.toLowerCase()});  
        } catch (error) {
            $(".erc_balance_loader").hide();
            $.notify("ERC withrawable balance not found.", "error");
            console.log("ERC withrawable Error Code:");
            console.log(error);
        }
    }
    
    async function withdrawEth() {
        var check = confirm("Do you want to withdraw ETH amount?")
        if(check) {
            paymentSuccessNotify();
            await withdraw();
        }
        
    }
    
    async function withdrawERC() {
        var check = confirm("Do you want to withdraw ERC amount?")
        if(check) {
            paymentSuccessNotifyERC20();
            await withdrawERC20();
        }
        
    }
    
    async function withdraw() {
        $(".eth_balance_loader").show();
        try {
           return await window.contract.methods.withdraw().send({from:ownerAddress.toLowerCase()});  
        } catch (error) {
            $(".eth_balance_loader").hide();
            $.notify("withdraw balance process is failed.", "error");
            console.log("withdraw ETH Error Code:");
            console.log(error);
        }
    }
    
    async function withdrawERC20() {
        $(".erc_balance_loader").show();
        try {
            console.log("Called withdrawERC20: " + tokenSmartContractAddress.toLowerCase());
            console.log("322434: " + ownerAddress.toLowerCase());
           return await window.contract.methods.withdrawERC20(tokenSmartContractAddress.toLowerCase()).send({
                from:ownerAddress.toLowerCase(),
                gasLimit: gasLimit,
                to: smartContractAddress.toLowerCase()
           });  
        } catch (error) {
            $(".eth_balance_loader").hide();
            $.notify("withdraw balance process is failed.", "error");
            console.log("withdraw ERC 20 Error Code:");
            console.log(error);
        }
    }
    
    async function paymentSuccessNotify() {
        var event = window.contract.events.EthPaymentSuccess(function(error, result) {
           if (!error) { 
               console.log("paymentSuccessNotify:");
               console.log(result);
               saveWithdrawalPaymentDetail("ETH",result);
            } else {
                $(".eth_balance_loader").hide();
                console.log("Error Occur in event:");
                console.log(error);
            }
        });
    }
    
    async function paymentSuccessNotifyERC20() {
        var event = window.contract.events.ERC20PaymentSuccess(function(error, result) {
           if (!error) { 
               console.log("paymentSuccessNotifyERC20:");
               console.log(result);
               saveWithdrawalPaymentDetail("UNIC",result);
            } else {
                $(".erc_balance_loader").show();
                console.log("Error Occur in event:");
                console.log(error);
            }
        });
    }
    
    function saveWithdrawalPaymentDetail(type,result) {   
        var amount;    
        if(type == "UNIC") {
            var amount = parseInt(result.returnValues.amount);   
        } else {
            var amount = window.web3.utils.fromWei(result.returnValues.amount.toString(), 'ether');
        }
        
        var url = "{{ route('admin.store-withdraw-transactions') }}";
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'json',
            data: {
                signature:result.signature,
                transaction_hash:result.transactionHash,
                from_address:result.returnValues.from,
                to_address:result.returnValues.to,
                amount:amount,
                block_no:result.blockNumber,
                status:result.returnValues.success,
                symbol:type,
            },
            success: function(data) {
                $(".eth_balance_loader").hide();
                $(".erc_balance_loader").show();
                $.notify(type + "amount withdraw successfully.", "success");
                setTimeout(function() {
                    location.reload();
                },5000);
            }
        });
    }
</script>
@endpush
@endsection