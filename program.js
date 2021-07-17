// 程式題-1
function minimumNum(arr){
    let min = Infinity
    let counter = 0
    for(const num of arr){
        if(num == min){
            counter++
        }
        if(num < min){
            min = num
            counter = 1
        }
    }
    return `N = ${min}, Count = ${counter}`
}

// 程式題-2
function transferCurrency(price, rate){
    const priceToNum = Number(price.split(" ")[1].replace(",", ""))
    const twd = Math.round(priceToNum * rate).toString()
    let counter = 0
    let result = ""
    for(let i = twd.length - 1; i >= 0; i-- ){   
        if(counter > 0 && counter % 3 == 0){
            result = twd[i] + "," + result
        } else {
            result = twd[i] + result
        }
        counter++
    }
    return `TWD ${result}`
}

module.exports = {
    minimumNum,
    transferCurrency
}