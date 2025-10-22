const EstimationBill = () => {
  return (
    <>
      <section className="billHeaderSection">
        <div className="container">
          <div className="flexBlock">
            <div className="logoTitle">
              <div className="image">
                {/* <img src="assets/images/favicon.png" alt="" /> */}
                <img src="assets/images/logo/voydGreen.png" alt="" />
              </div>
              {/* <div className="titles">
                <h2>VOYD Interior</h2>
                <h2>Designing Solutions</h2>
              </div> */}
            </div>
            <div className="sideTitleBlock">
              <h3>Project Estimation Bill</h3>
              <p>Effortlessly handle your estimation bill right here.</p>
            </div>
          </div>
          <div className="row cardDetailsRow">
            <div className="col-md-5 columns">
              <div className="cardOneOuter">
                <div className="cardOne">
                  <h6>Estimated By:</h6>
                  <h5>VOYD Interior Execution Partner</h5>
                  <p>
                    305, 3rd Floor Nexus mall, Hyderabad, Telengana, India -
                    560055
                  </p>
                  <div className="contacts">
                    <span className="email">Email</span>
                    <span>info@voyd.com</span>
                  </div>
                  <div className="contacts">
                    <span>Phone</span>
                    <span>+1 9876543212</span>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-5 columns">
              <div className="cardOneOuter">
                <div className="cardOne">
                  <h6>Estimation to:</h6>
                  <h5>
                    <span>
                      <img
                        src="assets/images/pngtree-businessman-user-avatar.png"
                        alt=""
                      />
                    </span>
                    S Hari Satya
                  </h5>
                  <p>
                    6005, 6th Floor My Home Bhooja, Hyderabad, Telengana, India
                    - 560055
                  </p>
                  <div className="contacts">
                    <span className="email">Email</span>
                    <span>harisatya@voyd.com</span>
                  </div>
                  <div className="contacts">
                    <span>Phone</span>
                    <span>+91 9876543212</span>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-2">
              <div className="amountCard">
                <h6>Estimation Amount</h6>
                <div>
                  <h3>2,75,830.00</h3>
                  <h4>INR</h4>
                </div>
                <p>July 26, 2025</p>
              </div>
            </div>
          </div>
          <div className="row">
            <div className="col-md-12">
              <div className="billTableCard">
                {/* ----------------first model table ----------------- */}
                <div className="billTable">
                  <table>
                    <tr>
                      <th className="center">Area</th>
                      <th>Room</th>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td rowSpan={4}>
                          <h5>Living Room</h5>
                        </td>
                        <td>Living Room 1</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 2</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 3</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 4</td>
                        <td>
                          1.King Size Bed
                          <p> 2. Wardrobe</p>
                        </td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr className="subTotalRow">
                        <td colSpan={6}>
                          <span>SUB TOTAL</span>
                          <h4>₹ 1,25,000.00</h4>
                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td rowSpan={4}>
                          <h5>Living Room</h5>
                        </td>
                        <td>Living Room 1</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 2</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 3</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 4</td>
                        <td>
                          1.King Size Bed
                          <p> 2. Wardrobe</p>
                        </td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr className="subTotalRow">
                        <td colSpan={6}>
                          <span>SUB TOTAL</span>
                          <h4>₹ 1,25,000.00</h4>
                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td rowSpan={4}>
                          <h5>Living Room</h5>
                        </td>
                        <td>Living Room 1</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 2</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 3</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 4</td>
                        <td>
                          1.King Size Bed
                          <p> 2. Wardrobe</p>
                        </td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr className="subTotalRow">
                        <td colSpan={6}>
                          <span>SUB TOTAL</span>
                          <h4>₹ 1,25,000.00</h4>
                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td rowSpan={4}>
                          <h5>Living Room</h5>
                        </td>
                        <td>Living Room 1</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 2</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 3</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 4</td>
                        <td>
                          1.King Size Bed
                          <p> 2. Wardrobe</p>
                        </td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr className="subTotalRow">
                        <td colSpan={6}>
                          <span>SUB TOTAL</span>
                          <h4>₹ 1,25,000.00</h4>
                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td rowSpan={4}>
                          <h5>Living Room</h5>
                        </td>
                        <td>Living Room 1</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 2</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 3</td>
                        <td>1.King Size Bed</td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr>
                        <td>Living Room 4</td>
                        <td>
                          1.King Size Bed
                          <p> 2. Wardrobe</p>
                        </td>
                        <td>1</td>
                        <td>1,00,000.00</td>
                        <td>1,00,000.00</td>
                      </tr>
                      <tr className="subTotalRow">
                        <td colSpan={6}>
                          <span>SUB TOTAL</span>
                          <h4>₹ 1,25,000.00</h4>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div className="grandTotal">
                  <h3>Grand Total</h3>
                  <h3>₹ 3,75,000.00</h3>
                </div>
                <div className="termsBlock">
                  <h6>Terms & Conditions:</h6>
                  <p>
                    Fees and payment terms will be established in the contract
                    or agreement prior to the commencement of the project. An
                    initial deposit will be required before any design work
                    begins. We reserve the right to suspend or halt work in the
                    event of non-payment.
                  </p>
                </div>
                <div className="contactBlock">
                  <div className="details">
                    <h6>VOYD Interior Designing Solutions</h6>
                    <p>www.voyd.com</p>
                    <p>
                      info@voyd.com <span>/ +91 98765 43210</span>
                    </p>
                  </div>
                  <div className="logo">
                    <img src="assets/images/logo/voydGreen.png" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};
export default EstimationBill;
