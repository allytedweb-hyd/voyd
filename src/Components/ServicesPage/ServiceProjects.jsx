import React from 'react'
import { PiArrowCircleRight } from "react-icons/pi";

const ServiceProjects = () => {
  
  return (
    <div>
      <section className='bg-dark text-light mt-min pb-5 pdng-mob'>
        <div className="container pt-5 ptt-res">
         
            <h1 className='fnt-wt-3 hed-fnt'>OUR FEATURED PROJECTS</h1>
          <div className='d-flex justify-content-between'>
            <div><p className='text-light'>Discover our exceptional projects. Each one a testament to our <br /> commitment to excellence in interior design. Get inspired for your own space.</p></div>
            <div className='numb-siz'>01/09</div>
          </div>
         
          <div className="row d-flex pt-4">
            <div className="col-md-4 col-sm-4 j-centerr">
            <div>
              <div><img src="assets/images/Project Image.png" alt="" className=''/></div>
              <div><h3 className='fnt-wt-3 pt-3 sub-hng'>Office Room Allyted Corp</h3></div>
              <div><p className='text-light'>Furniture Selection • Manikonda Phase 4</p></div>
            </div>
            </div>
            
            <div className="col-md-4 col-sm-4 j-centerr">
            <div>
              <div><img src="assets/images/Project Image (2).png" alt="" className=''/></div>
              <div><h3 className='fnt-wt-3 pt-3 sub-hng'>Cafe Sand & Dunes</h3></div>
              <div><p className='text-light'>Space Planning • Jubilee Hills , Kamalapuri Colony</p></div>
            </div>
            </div>
            <div className="col-md-4 col-sm-4 j-centerr">
            <div>
              <div><img src="assets/images/Project Image (3).png" alt="" className=''/></div>
              <div><h3 className='fnt-wt-3 pt-3 sub-hng'>Raffi Ahmad Kitchen Set</h3></div>
              <div><p className='text-light'>Furniture Selection • South Jakarta</p></div>
            </div>
            </div>
            
          </div>
          <div className="row justify-content-end d-none">
          <div><PiArrowCircleRight className="fnt-50"/>
</div></div>
        </div>
      </section>
    </div>
  )
}

export default ServiceProjects