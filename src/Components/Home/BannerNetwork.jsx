import React from 'react'

const BannerNetwork = () => {
  return (
      <div>
          <section className='bn-sec'>
              
                  <div className="row net-row">
                      <div className="col-md-7 text-left pl-79">
                          <h1 className='netwrk-txt'>A Network of <span className='col-gren'>300</span> Interior Design Companies</h1>
                          <div><p className='col-grey fnt-24'>Collaborating with over 300 interior design companies, we form a powerhouse of creativity and expertise</p></div>
                          <button className='btn btn btn-success btn-greenish'>CTA Button</button>
                      </div>
                      
        </div>
        <div className="row">
          <div className="col-md-12">
         
                      <video width="100%" controls autoPlay loop muted>
      <source src="assets/images/network Video (1) (1) (1).mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
                      
                      </div>
        </div>
              {/* <div className="row iujhgf">
              <video width="600" controls autoPlay loop muted>
      <source src="assets/images/network Video.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
              </div> */}
           
          </section>
    </div>
  )
}

export default BannerNetwork