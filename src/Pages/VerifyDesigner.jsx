import { useRef, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import "./VerifyDesigner.css";

const VerifyDesigner = () => {
  const [step, setStep] = useState(1);
  const [loading, setLoading] = useState(false);
  const [errorMsg, setErrorMsg] = useState("");

  const [name, setName] = useState("");
  const [mobile, setMobile] = useState("");
  const [otp, setOtp] = useState(["", "", "", ""]);
  const [shopName, setShopName] = useState("");
  const [designerName, setDesignerName] = useState("");
  const [designerMobile, setDesignerMobile] = useState("");

  const otpRefs = useRef([]);
  const progressByStep = { 1: 25, 2: 50, 3: 75, 4: 100 };

  const goBack = () => { setErrorMsg(""); setStep(step - 1); };

  const startOver = () => {
    setName(""); setMobile(""); setOtp(["", "", "", ""]);
    setShopName(""); setDesignerName(""); setDesignerMobile("");
    setErrorMsg(""); setStep(1);
  };

  // OTP box: type and auto jump to next box
  const handleOtpChange = (idx, value) => {
    const digit = value.replace(/[^0-9]/g, "").slice(-1);
    const updated = [...otp];
    updated[idx] = digit;
    setOtp(updated);
    if (digit && idx < 3) otpRefs.current[idx + 1]?.focus();
  };

  const handleOtpKeyDown = (idx, e) => {
    if (e.key === "Backspace" && !otp[idx] && idx > 0) {
      otpRefs.current[idx - 1]?.focus();
    }
  };

  // STEP 1: Send OTP
  const handleSendOtp = async () => {
    if (!name.trim() || !mobile.trim()) {
      setErrorMsg("Please enter both name and mobile number.");
      return;
    }
    if (mobile.length !== 10) {
      setErrorMsg("Please enter a valid 10-digit mobile number.");
      return;
    }
    setErrorMsg("");
    setLoading(true);
    try {
      const res = await fetch(`${environmentUrl}/verify-vendor/send_otp.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, mobile }),
      });
      const data = await res.json();
      if (data.status) {
        setOtp(["", "", "", ""]);
        setStep(2);
        setTimeout(() => otpRefs.current[0]?.focus(), 100);
      } else {
        setErrorMsg(data.message || "Failed to send OTP. Try again.");
      }
    } catch (err) {
      setErrorMsg("Something went wrong. Please try again.");
    }
    setLoading(false);
  };

  // STEP 2: Verify OTP
  const handleVerifyOtp = async () => {
    const enteredOtp = otp.join("");
    if (enteredOtp.length < 4) {
      setErrorMsg("Please enter the complete 4-digit OTP.");
      return;
    }
    setErrorMsg("");
    setLoading(true);
    try {
      const res = await fetch(`${environmentUrl}/verify-vendor/verify_otp.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ mobile, otp: enteredOtp }),
      });
      const data = await res.json();
      if (data.status) {
        setStep(3);
      } else {
        setErrorMsg(data.message || "Incorrect OTP. Please try again.");
      }
    } catch (err) {
      setErrorMsg("Something went wrong. Please try again.");
    }
    setLoading(false);
  };

  // STEP 3: just go to step 4 for now (static result)
  const handleVerifyDesigner = () => {
    setStep(4);
  };

  return (
    <div className="vd-page">
      <div className="vd-bg-stage"></div>
      <div className="vd-blob b1"></div>
      <div className="vd-blob b2"></div>
      <div className="vd-blob b3"></div>
      <div className="vd-blob b4"></div>

      <section className="vd-hero">
        <h1>Verify Your <em>Interior Designer</em></h1>
        <p>Before you sign anything, know who you're working with. Confirm your number and we'll check the designer's record in seconds.</p>
      </section>

      <div className="vd-stage">
        <div className="vd-side-deco left"><div className="vtext">Trusted Verification</div></div>
        <div className="vd-side-deco right"><div className="vtext">Voyd Interiors</div></div>

        <div className="vd-progress-line">
          <div className="vd-fill" style={{ width: progressByStep[step] + "%" }}></div>
        </div>

        <div className="vd-card">

          {/* STEP 1 */}
          {step === 1 && (
            <div>
              <div className="vd-screen-tag"><span className="vd-num">1</span> Your Details</div>
              <h2>Let's start with you</h2>
              <p className="vd-sub">Enter your name and mobile number to begin verification.</p>

              <div className="vd-field">
                <label>Full Name</label>
                <input type="text" placeholder="e.g. Priya Sharma" value={name} onChange={(e) => setName(e.target.value)} />
              </div>
              <div className="vd-field">
                <label>Mobile Number</label>
                <div className="vd-phone-row">
                  <div className="vd-cc">🇮🇳 +91</div>
                  <input type="tel" maxLength={10} placeholder="10-digit mobile number" value={mobile} onChange={(e) => setMobile(e.target.value.replace(/[^0-9]/g, ""))} />
                </div>
              </div>

              {errorMsg && <div className="vd-error-msg">{errorMsg}</div>}
              <button className="vd-btn-primary" onClick={handleSendOtp} disabled={loading}>
                {loading ? "Sending..." : "Send OTP →"}
              </button>
            </div>
          )}

          {/* STEP 2 */}
          {step === 2 && (
            <div>
              <div className="vd-screen-tag"><span className="vd-num">2</span> Verify OTP</div>
              <h2>Verify your number</h2>
              <p className="vd-sub">Enter the 4-digit OTP sent to +91 {mobile}.</p>

              <div className="vd-otp-boxes">
                {otp.map((digit, idx) => (
                  <input
                    key={idx}
                    type="text"
                    inputMode="numeric"
                    maxLength={1}
                    value={digit}
                    ref={(el) => (otpRefs.current[idx] = el)}
                    onChange={(e) => handleOtpChange(idx, e.target.value)}
                    onKeyDown={(e) => handleOtpKeyDown(idx, e)}
                    className="vd-otp-box"
                  />
                ))}
              </div>

              {errorMsg && <div className="vd-error-msg">{errorMsg}</div>}
              <button className="vd-btn-primary" onClick={handleVerifyOtp} disabled={loading}>
                {loading ? "Verifying..." : "Verify OTP"}
              </button>
              <div className="vd-btn-link-back" onClick={goBack}>← Back</div>
            </div>
          )}

          {/* STEP 3 */}
          {step === 3 && (
            <div>
              <div className="vd-screen-tag"><span className="vd-num">3</span> Designer Info</div>
              <h2>Tell us about the designer</h2>
              <p className="vd-sub">We'll check this designer against our records.</p>
              <div className="vd-field">
                <label>Shop Name</label>
                <input type="text" placeholder="e.g. Elegant Interiors Studio" value={shopName} onChange={(e) => setShopName(e.target.value)} />
              </div>
              <div className="vd-field">
                <label>Interior Designer Name</label>
                <input type="text" placeholder="e.g. Rohit Verma" value={designerName} onChange={(e) => setDesignerName(e.target.value)} />
              </div>
              <div className="vd-field">
                <label>Designer's Mobile Number</label>
                <div className="vd-phone-row">
                  <div className="vd-cc">🇮🇳 +91</div>
                  <input type="tel" maxLength={10} placeholder="10-digit mobile number" value={designerMobile} onChange={(e) => setDesignerMobile(e.target.value.replace(/[^0-9]/g, ""))} />
                </div>
              </div>
              <button className="vd-btn-primary" onClick={handleVerifyDesigner}>
                Verify Designer →
              </button>
              <div className="vd-btn-link-back" onClick={goBack}>← Back</div>
            </div>
          )}

          {/* STEP 4 */}
          {step === 4 && (
            <div className="vd-result vd-ok">
              <div className="vd-badge">✓</div>
              <h2>Designer is Not a Defaulter</h2>
              <p>Good news — we found no defaults on record for this designer. You can proceed with confidence, though we always recommend a written agreement before work begins.</p>
              <div className="vd-summary">
                <div><span>Shop Name</span><b>{shopName || "-"}</b></div>
                <div><span>Designer Name</span><b>{designerName || "-"}</b></div>
                <div><span>Mobile</span><b>+91 {designerMobile || "-"}</b></div>
              </div>
              <button className="vd-btn-primary" onClick={startOver}>Verify Another Designer</button>
            </div>
          )}

        </div>
        <div className="vd-footer-note">POWERED BY VOYD · YOUR DETAILS ARE USED ONLY TO VERIFY DESIGNER RECORDS</div>
      </div>
    </div>
  );
};

export default VerifyDesigner;
