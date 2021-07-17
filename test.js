const { minimumNum, transferCurrency } = require("./Asiayo")
const {expect} = require("chai")

describe("minimumNum", () => {
    it("should return the minimum number in array and the number of it", () => {
        expect(minimumNum([1, 9, 15, 3, 29, 19])).to.deep.equal("N = 1, Count = 1")
        expect(minimumNum([4999, 3999, 2999, 1999])).to.deep.equal("N = 1999, Count = 1")
    })
})

describe("transferCurrency", () => {
    it("should return TWD round off to integer", () => {
        expect(transferCurrency("USD 11,222.02", 32.23)).to.deep.equal("TWD 361,686")
        expect(transferCurrency("JPY 31,999", 0.35)).to.deep.equal("TWD 11,200")
    })
})

