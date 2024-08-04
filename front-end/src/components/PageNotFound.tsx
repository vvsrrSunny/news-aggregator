import { useNavigate } from 'react-router-dom';

export default function PageNotFound() {
  const navigate = useNavigate();

  return (
    <>
      <main className="grid min-h-full place-items-center bg-black px-6 py-24 sm:py-32 lg:px-8">
        <div className="text-center">
          <p className="text-base font-semibold text-primary">404</p>
          <h1 className="mt-4 text-3xl font-semibold tracking-tight text-gray-100 sm:text-5xl">
            Page not found
          </h1>
          <p className="mt-6 text-base leading-7 text-gray-300">
            Sorry, we couldn’t find the page you’re looking for.
          </p>
          <div className="mt-10 flex items-center justify-center gap-x-6">
            <button
              onClick={() => navigate(-1)}
              className="rounded-md bg-primary px-3.5 py-2.5 text-sm font-medium text-black shadow-sm hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Go back
            </button>
            <button className="text-sm font-semibold text-gray-300">
              Contact support <span aria-hidden="true">&rarr;</span>
            </button>
          </div>
        </div>
      </main>
    </>
  );
}
