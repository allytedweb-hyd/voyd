import { Toaster } from "sonner";

const Sonner = () => {
  return (
    <>
      {/* <Toaster
        position="bottom-center"
        expand={false}
        richColors
        closeButton
        pauseWhenHovering
      /> */}
      <Toaster
        className="sonnerToaster"
        position="bottom-center"
        expand={false}
        richColors
        closeButton
        pauseWhenHovering
        toastOptions={{
          duration: 3000,
          classNames: {
            toast: "custom-toast",
          },
        }}
      />
    </>
  );
};

export default Sonner;
