// import { Link } from "react-router-dom";

const EmailTemplate = () => {
  return (
    <>
      <table width="100%" cellPadding="0" cellSpacing="0">
        <tr>
          <td style="background-color:#dddddd">
            {/* <!-- ========= Table content ========= --> */}

            <table
              cellPadding="0"
              cellSpacing="0"
              width="600"
              className="table-mobile"
              align="center"
            >
              <tr>
                <td height="25"></td>
              </tr>

              {/* <!-- ========= Header ========= --> */}

              <tr>
                <td>
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    className="table-mobile-small"
                    align="center"
                  >
                    <tr>
                      <td className="header-item">
                        <img alt="" width="150" />
                      </td>
                      <td className="header-item">
                        <p style="font-family:sans-serif;font-size:20px;font-weight:bold;text-transform:uppercase;margin-top:0;margin-bottom:0;color:#484848;text-align:right;">
                          Invoice
                        </p>
                        <p style="font-family:sans-serif;font-size:12px;font-weight:normal;text-transform:uppercase;margin-top:0;margin-bottom:0;color:#484848;text-align:right;">
                          WEB8974635
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              {/* <!-- ========= Divider ========= --> */}

              <tr>
                <td>
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    width="100%"
                    align="center"
                  >
                    <tr>
                      <td height="20"></td>
                    </tr>
                    <tr>
                      <td
                        style="border-bottom:1px solid #f8f8f8;"
                        height="1"
                      ></td>
                    </tr>
                  </table>
                </td>
              </tr>

              {/* <!-- ========= Intro text ========= --> */}

              <tr>
                <td style="background:#f7f7f7;padding:35px 0;border-top:1px solid #eeeeee;">
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    className="table-mobile-small"
                    align="center"
                  >
                    <tr>
                      <td colSpan="2">
                        <p style="font-family:sans-serif;font-size:22px;font-weight:bold;text-transform:none;margin-top:0;margin-bottom:10px;color:#464951;text-align:left;">
                          Your order is completed!!
                        </p>
                        <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:20px;color:#464951;text-align:left;">
                          Dear costumer, your payment for your online order
                          placed on Divano Furniture Store order and has been
                          approved order reference number:
                          <strong>WEB8974635</strong>. Please note that we will
                          appear on your card statement. To get further payment
                          support for your purchase, please sign-up using your
                          email address at
                          <a
                            href="#"
                            style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;color:#3a3d45;text-decoration:underline;"
                          >
                            Divano Furniture Store
                          </a>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              {/* <!-- ========= User info ========= --> */}

              <tr>
                <td style="background:#ffffff;padding:35px 0;border-top:1px solid #eeeeee;border-bottom:1px solid #eeeeee;">
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    className="table-mobile-small"
                    align="center"
                  >
                    <tr>
                      <td width="50%" valign="top">
                        <table
                          cellPadding="0"
                          cellSpacing="0"
                          width="100%"
                          align="center"
                        >
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:22px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Shipping info</strong>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Name:</strong> John Doe
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Phone:</strong> +122 523 352
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Email:</strong> johndoe@company.com
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Address:</strong> 795 Folsom Ave, Suite
                                600
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>City:</strong> San Francisco, California
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Zip:</strong> 94107
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td width="50%" valign="top">
                        <table
                          cellPadding="0"
                          cellSpacing="0"
                          width="100%"
                          align="center"
                        >
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:22px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Order details</strong>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Order no.:</strong> 52522-63259226
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Order date :</strong> 06/30/2017
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Transaction ID :</strong> 2265996
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Transaction time :</strong> 06/30/2017
                                at 00:59
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Cart details:</strong> **** **** ****
                                5446
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;padding-bottom:5px;border-bottom:1px solid #f5f5f5;">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#3a3d45;text-align:left;">
                                <strong>Invoice total:</strong> $ 1259,00
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              {/* <!-- ========= Booking details ========= --> */}

              <tr>
                <td style="background-color:#ffffff;">
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    width="100%"
                    align="center"
                  >
                    <tbody>
                      {/* <!----------- product table header -----------> */}

                      <tr className="product-header">
                        <td
                          width="180"
                          valign="middle"
                          style="background-color:#f7f7f7;width:180px;"
                        >
                          <p style="font-family:sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:left;">
                            Product
                          </p>
                        </td>
                        <td valign="middle" style="background-color:#f7f7f7;">
                          <p style="font-family:sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:left;">
                            Quantity
                          </p>
                        </td>
                        <td
                          valign="middle"
                          align="right"
                          style="background-color:#f7f7f7;"
                        >
                          <p style="font-family:sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:right;">
                            Price
                          </p>
                        </td>
                      </tr>

                      {/* <!--product--> */}

                      <tr>
                        <td
                          width="200"
                          valign="middle"
                          className="product-image"
                          style="width:200px;"
                        >
                          <a
                            href="#"
                            style="margin:0;padding:0;text-decoration:none;"
                          >
                            <img
                              src="assets/images/product-1.jpg"
                              alt=""
                              width="180"
                            />
                          </a>
                        </td>
                        <td
                          width="300"
                          valign="middle"
                          className="product-title"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:left;">
                            Sophie Sofa
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:left;">
                            Category item
                          </p>
                        </td>
                        <td
                          width="100"
                          valign="middle"
                          className="product-price"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:right;">
                            $ 1.998
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:right;text-decoration:line-through;">
                            $ 2.666
                          </p>
                        </td>
                      </tr>

                      {/* <!--product--> */}

                      <tr>
                        <td
                          width="200"
                          valign="middle"
                          className="product-image"
                          style="width:200px;"
                        >
                          <a
                            href="#"
                            style="margin:0;padding:0;text-decoration:none;"
                          >
                            <img
                              src="assets/images/product-2.jpg"
                              alt=""
                              width="180"
                            />
                          </a>
                        </td>
                        <td
                          width="300"
                          valign="middle"
                          className="product-title"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:left;">
                            Chair Nora
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:left;">
                            Category item
                          </p>
                        </td>
                        <td
                          width="100"
                          valign="middle"
                          className="product-price"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:right;">
                            $ 1.998
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:right;text-decoration:line-through;">
                            $ 2.666
                          </p>
                        </td>
                      </tr>

                      {/* <!--product--> */}

                      <tr>
                        <td
                          width="200"
                          valign="middle"
                          className="product-image"
                          style="width:200px;"
                        >
                          <a
                            href="#"
                            style="margin:0;padding:0;text-decoration:none;"
                          >
                            <img
                              src="assets/images/product-3.jpg"
                              alt=""
                              width="180"
                            />
                          </a>
                        </td>
                        <td
                          width="300"
                          valign="middle"
                          className="product-title"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:left;">
                            Grace Kitchen
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:left;">
                            Category item
                          </p>
                        </td>
                        <td
                          width="100"
                          valign="middle"
                          className="product-price"
                        >
                          <p style="font-family:sans-serif;font-size:18px;font-weight:bold;text-transform:uppercase;margin:0;color:#3a3d45;text-align:right;">
                            $ 1.998
                          </p>
                          <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin:0;color:#60636b;text-align:right;text-decoration:line-through;">
                            $ 2.666
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>

              {/* <!-- ========= Booking price ========= --> */}

              <tr>
                <td
                  style="background-color:#f7f7f7;color:#3a3d45;padding:25px 0;"
                  className="footer-content"
                >
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    className="table-mobile-small"
                    align="center"
                  >
                    <tr>
                      <td style="padding-bottom:20px;">
                        <table
                          cellPadding="0"
                          cellSpacing="0"
                          width="100%"
                          align="center"
                        >
                          <tr>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:left;">
                                <strong>Discount 15%</strong>
                              </p>
                            </td>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:right;">
                                $ 159,00
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:left;">
                                <strong>Shipping</strong>
                              </p>
                            </td>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:right;">
                                $ 30,00
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:left;">
                                <strong>VAT / TAX</strong>
                              </p>
                            </td>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:3px 0;color:#3a3d45;text-align:right;">
                                $ 59,00
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>

                    <tr>
                      <td style="padding-top:20px; border-top:1px solid #dddddd">
                        <table
                          cellPadding="0"
                          cellSpacing="0"
                          width="100%"
                          align="center"
                        >
                          <tr>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:28px;font-weight:bold;text-transform:none;margin-top:0;margin-bottom:0;padding:0;color:#3a3d45;text-align:left;">
                                <strong>Total price</strong>
                              </p>
                            </td>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:28px;font-weight:bold;text-transform:none;margin-top:0;margin-bottom:0;padding:0;color:#3a3d45;text-align:right;">
                                $ 1259,00
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:0;color:#a6acbb;text-align:left;">
                                <strong>You save</strong>
                              </p>
                            </td>
                            <td width="50%" valign="top">
                              <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:0;color:#a6acbb;text-align:right;">
                                $ 159,00
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <tr>
                <td style="padding-top:20px;">
                  <table
                    cellPadding="0"
                    cellSpacing="0"
                    className="table-mobile-small"
                    align="center"
                  >
                    <tr>
                      <td>
                        <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:20px;padding:0;color:#484848;text-align:center;">
                          Payments should be made within 30 days with one of the
                          options below, or you can enter any note here if
                          necessary, you have much space:
                        </p>
                        <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;padding:0;color:#484848;text-align:center;">
                          <strong>Payment Methods:</strong> Cheque, PayPal,
                          WesternUnion <br />
                          <strong>We accept:</strong> MasterCard, Visa,
                          AmericanExpress <br />
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <tr>
                <td height="25"></td>
              </tr>
            </table>

            {/* <!-- ========= Footer ========= --> */}

            <table
              cellPadding="0"
              cellSpacing="0"
              className="table-mobile-small"
              align="center"
            >
              <tr>
                <td style="padding:25px 0;">
                  <p style="font-family:sans-serif;font-size:14px;font-weight:bold;text-transform:none;margin-top:0;margin-bottom:20px;padding:0;color:#3a3d45;text-align:center;">
                    THANK YOU VERY MUCH FOR CHOOSING OUR PRODUCT
                  </p>
                  <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:20px;padding:0;color:#aaaaaa;text-align:center;">
                    You are receiving this because you are a current subscriber,{" "}
                    <br />
                    or have bought from our website.
                  </p>
                  <p style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:20px;padding:0;color:#3a3d45;text-align:center;">
                    <a
                      style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;color:#3a3d45;text-decoration:underline;"
                      href="#"
                    >
                      Subscribe
                    </a>{" "}
                    |
                    <a
                      style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;color:#3a3d45;text-decoration:underline;"
                      href="#"
                    >
                      Unsubscribe
                    </a>{" "}
                    |
                    <a
                      style="font-family:sans-serif;font-size:14px;font-weight:normal;text-transform:none;margin-top:0;margin-bottom:0;color:#3a3d45;text-decoration:underline;"
                      href="#"
                    >
                      Forward
                    </a>
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </>
  );
};

export default EmailTemplate;
