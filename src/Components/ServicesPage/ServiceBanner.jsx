import React from 'react'
import { HiOutlineArrowSmRight } from "react-icons/hi";


const ServiceBanner = () => {
  return (
      <div>
          
          <section className='serv-bg-img d-flex justify-content-center align-items-center '>
              <div className="container pding-container mx-85">
              <div className="row w-100">
                  <div className="col-md-6">
                      <h4 className='cinzel-font text-light serv-ban-hdng'>OUr Services</h4>
                      <div><h1 className='pf-display text-light text-left baner-hdng'>Creating Harmony Through Design</h1></div>
                  </div>
                  <div className="col-md-6 text-light text-start int-txt">
                      <div>
                      
                      <h5 className='serv-bnr-hdng '>Interior design is the art and science of enhancing the interior spaces of buildings to achieve a more functional.</h5>
                      <button className='serv-con-btn bg-light'>Contact Us <HiOutlineArrowSmRight  className='arow-rot'/>
                      </button>
                    </div>
                  </div>
              </div>
              </div>
          </section>
    </div>
  )
}

export default ServiceBanner